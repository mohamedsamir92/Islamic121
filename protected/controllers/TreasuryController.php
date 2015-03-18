<?php

class TreasuryController extends Controller {

	public function actionReport() {
		$this -> render("report");
	}

	public function actionPaper() {
		if ($_POST) {

			$transaction = Yii::app() -> db -> beginTransaction();
			try {

				$paper = new TreasuryPaper;
				$paper -> currency_id = $_POST['currency_id'];
				if ($_POST['type'] == 0) {
					$user = Users::model() -> find("username = :uname", array(":uname" => $_POST["username"]));

					$paper -> user_id = $user -> profile_id;
					$paper -> user_type = $user -> type;
				}
				$paper -> paper_type = $_POST['paper_type'];
				$paper -> type = $_POST['type'];
				$paper -> value = $_POST['value'];
				$paper -> notes = $_POST['notes'];
				$paper -> date = $_POST['date'];
				$paper -> actual_date = date('Y-m-d H:i:s');

				$existing_treasury = Treasury::model() -> find("currency_id = :id", array(":id" => $_POST['currency_id']));
				if (count($existing_treasury) == 0) {
					$treasury = new Treasury;
					$treasury -> currency_id = $_POST['currency_id'];
					$treasury -> value = $_POST['value'] * $_POST['paper_type'];
					$treasury -> save();
					$paper -> current_total_value = $_POST['value'] * $_POST['paper_type'];
					$paper -> save();
				} else {
					$existing_treasury -> value = $existing_treasury -> value + ($_POST['value'] * $_POST['paper_type']);
					$paper -> current_total_value = $existing_treasury -> value;
					$existing_treasury -> save();
					$paper -> save();
				}

				if ($_POST['type'] == 0) {
					$newValue = $user -> value;
					if ($newValue < 0) {
						$newValue += ($_POST['value'] * $_POST['paper_type']);
						if ($newValue > 0)
							$newValue = 0;
					} else if ($newValue == 0 && $_POST['paper_type'] == -1)
						$newValue += ($_POST['value'] * $_POST['paper_type']);

					$user -> value = $newValue;
					$user -> save();
				}

				$transaction -> commit();
				$this -> render("paper", array("my_message" => "Success"));
			} catch (Exception $e) {
				var_dump($e);
				$transaction -> rollBack();
				$this -> render("paper", array("my_message" => "Failure"));
			}
		} else
			$this -> render("paper");

	}

	public function actionGetTransactions() {
		$from = $_GET['from'];
		$to = $_GET['to'];
		$currency = $_GET['currency'];

		$records = TreasuryPaper::model() -> findAll("currency_id = :currency and date >=  :from ORDER BY date", array(":currency"=>$currency,":from" => $from));
		$totalInCurrency = Treasury::model()->find("currency_id = :currency" , array(":currency" => $currency));
		if(count($totalInCurrency) == 0){
			echo "{\"data\":[]}";
			return ;
		}
		$currentTotal = $totalInCurrency->value;
		$result = array();
		$result["data"] = array();
		$totals = array();
		for($i=count($records)-1;$i>=0;$i--){
			$currentTotal = $currentTotal + (-1 * $records[$i]->paper_type * $records[$i]->value);
			array_unshift($totals,$currentTotal);	
		}
		
		
		
		$i = 0;
		
		foreach ($records as $record) {
			if($record->date > $to)
				break;
			$result["data"][] = array();
			$result["data"][$i][] = $record->date;
			if($record->type == 1)
				$result["data"][$i][] = "Other";
			else{
				
				if($record->user_type == 2){
					$type = "Admin";
					$user = Admin::model()->find("id = ".$record->user_id);
				}
				else if($record->user_type == 1){
					$type = "Teacher";
					$user = Teacher::model()->find("id = ".$record->user_id);
				
				}
				else if($record->user_type == 0){
					$type = "Student";
					$user = Student::model()->find("id = ".$record->user_id);
				}
				$result["data"][$i][] = $type . " " . $user->first_name . " " . $user->last_name;
			
			}
			$result["data"][$i][] = $record->notes;
			if($record->paper_type == 1)
				$result["data"][$i][] = "In";
			else
				$result["data"][$i][] = "Out";
			$result["data"][$i][] = $record->value;
			$result["data"][$i][] = $totals[$i] + ($record->paper_type * $record->value);
			$i++;	
		}
		
		echo json_encode($result);
		

	}

}
