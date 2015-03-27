<?php

class RequestsController extends Controller {

	public static function getRequests() {
		$pendingRequests = LessonRequest::model() -> findAll('status = 0');
		return count($pendingRequests);
	}

	public function actionCheckTeacher() {

		$message = "";
		$teacher = Teacher::model() -> find('id = ' . $_GET['id']);

		/*if (($teacher -> gender == 0 && $_GET['student_gender'] == "Female") || ($teacher -> gender == 1 && $_GET['student_gender'] == "Male")) {
		 $message = "Teacher and student should be both males or both females";
		 }*/
		$from_time = date("H:i", strtotime($_GET['from']));
		$to_time = date("H:i", strtotime($_GET['to']));
		$dt_start = new DateTime('2001-01-01 ' . $from_time);
		$dt_end = new DateTime('2001-01-1 ' . $to_time);
		$dt_start_timestamp = $dt_start -> getTimestamp();
		$dt_end_timestamp = $dt_end -> getTimestamp();
		if ($dt_end_timestamp < $dt_start_timestamp) {
			$message = "Time interval isn't equal to period time";
		} else if (($dt_end_timestamp - $dt_start_timestamp) != ($_GET['period'] * 60)) {
			$message = "Time interval isn't equal to period time";
		} else {
			$type_of_lessons = TeacherTypeBridge::model() -> findAll("teacher_id = :id and type_id = :tid", array(":id" => $_GET['id'], ":tid" => $_GET['lesson_type']));
			if (count($type_of_lessons) == 0) {
				$message = "This teacher doesn't teach this type of lessons";
			} else {
				$teacher_slots = TeacherTimeSlot::model() -> findAll('teacher_id = ' . $_GET['id'] . ' and day = ' . $_GET['day']);
				$check = 0;
				foreach ($teacher_slots as $teacher_slot) {
					$dt_teacher_from = new DateTime('2001-01-01 ' . $teacher_slot -> from);
					$dt_teacher_to = new DateTime('2001-01-01 ' . $teacher_slot -> to);
					$dt_teacher_from_timestamp = $dt_teacher_from -> getTimestamp();
					$dt_teacher_to_timestamp = $dt_teacher_to -> getTimestamp();
					if ($dt_teacher_from_timestamp <= $dt_start_timestamp && $dt_teacher_to_timestamp >= $dt_end_timestamp) {
						$check = 1;
						break;
					}
				}
				if ($check == 0) {
					$message = "Selected teacher is not available";
				} else {

					$prevAcceptedRequests = LessonRequest::model() -> findAll('teacher_id = ' . $_GET['id'] . ' and status = 1');
					foreach ($prevAcceptedRequests as $acceptedReqeuest) {
						$timeSlots = LessonRequestTimeSlot::model() -> findAll("lesson_request_id = " . $acceptedReqeuest -> id);
						foreach ($timeSlots as $slot) {
							$dt_slot_from = new DateTime('2001-01-01 ' . $slot -> from);
							$dt_slot_to = new DateTime('2001-01-01 ' . $slot -> to);
							$dt_slot_from_timestamp = $dt_slot_from -> getTimestamp();
							$dt_slot_to_timestamp = $dt_slot_to -> getTimestamp();
							//var_dump($dt_start);
							//var_dump($dt_slot_to);

							//echo $dt_slot_from_timestamp." ".$dt_start;
							if ($slot -> day == $_GET['day'] && !(($dt_start_timestamp < $dt_slot_from_timestamp && $dt_end_timestamp <= $dt_slot_from_timestamp) || ($dt_start_timestamp >= $dt_slot_to_timestamp && $dt_end_timestamp > $dt_slot_to_timestamp))) {
								$message = "Teacher is not available in these times, try to edit times or select another teacher";
							}

						}
					}
				}
			}
		}
		//echo $message;

		if (strlen($message) < 1)
			$message = "Success";
		$result = array();
		$result["status"] = $message;
		echo json_encode($result);
	}

	public function actionIndex() {
		if (!isset(Yii::app() -> user -> id)) {
			$this -> redirect("index.php?r=DataModule/Login");
		}
		$this -> render('index');
	}

	function getWeekDay($day, $month, $year) {
		if (!isset(Yii::app() -> user -> id)) {
			$this -> redirect("index.php?r=DataModule/Login");
		}
		return date("l", strtotime($year . '-' . $month . '-' . $day));
	}

	public function actionEditRequest() {
		//var_dump($_POST);
		$message = "";
		$transaction = Yii::app() -> db -> beginTransaction();
		try {
			$request = LessonRequest::model() -> find("id = :id", array(":id" => $_POST["LessonRequest"]["id"]));
			$request -> cost = $_POST["LessonRequest"]["cost"];
			$request -> currency_id = $_POST["LessonRequest"]["currency"];
			$request -> notes = $_POST["LessonRequest"]["notes"];
			$request -> save();

			$user = Users::model() -> find("profile_id = :id and type = 0", array(":id" => $_POST["LessonRequest"]["student_id"]));
			$user -> currency_id = $_POST["LessonRequest"]["currency"];
			$user -> save();

			$transaction -> commit();
		} catch (Exception $e) {

			$message = "Failure in update process";
		}

		$result = LessonRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll("status = 0");
		$teachers = Teacher::model() -> findAll();
		$currencies = Currency::model() -> findAll();

		if (strlen($message) < 1)
			$message = "Request updated Successfully";
		$this -> redirect(array('PendingRequests'));

	}

	public function actionPendingRequests() {
		if (!isset(Yii::app() -> user -> id)) {
			$this -> redirect("index.php?r=DataModule/Login");
		}

		if (Yii::app() -> user -> type == "Admin") {
			$message = "";

			if ($_POST) {

				 $received_data = $_POST;
				 var_dump($received_data);
				 
				 $transaction = Yii::app() -> db -> beginTransaction();
				 try{
				 
				 	$request = LessonRequest::model() -> find("id = " . $received_data['LessonRequest']['request_id']);
				 	$request -> teacher_id = $received_data['LessonRequest']['teacher_id'];
				 	$request -> currency_id = $received_data['LessonRequest']['currency'];
				 	$request -> cost = $received_data['LessonRequest']['cost'];
				 	
				 	$days = array("Saturday" => 0, "Sunday" => 1, "Monday" => 2, "Tuesday" => 3, "Wednesday" => 4, "Thursday" => 5, "Friday" => 6);
				 	$user = Users::model()->find("profile_id = :id and type = 0",array(":id"=>$received_data['LessonRequest']['student_id'] ));
					$user->currency_id = $received_data['LessonRequest']['currency'];
					$user->save();
				 	
				 	/*for ($i = 0; $i < count($received_data['LessonRequest']['from']); $i++) {
				 	$from_time = date("H:i", strtotime($received_data['LessonRequest']['from'][$i]));
				 	$to_time = date("H:i", strtotime($received_data['LessonRequest']['to'][$i]));
				 	$dt_start = new DateTime('2001-01-01 ' . $from_time);
				 	$dt_end = new DateTime('2001-01-1 ' . $to_time);
				 	$dt_start_timestamp = $dt_start -> getTimestamp();
				 	$dt_end_timestamp = $dt_end -> getTimestamp();
				 	
				 	$teacher_slots = TeacherTimeSlot::model() -> findAll('teacher_id = ' . $received_data['LessonRequest']['teacher_id'] . ' and day = ' . $received_data['LessonRequest']['day'][$i]);
				 	$check = 0;
				 	foreach ($teacher_slots as $teacher_slot) {
				 		$dt_teacher_from = new DateTime('2001-01-01 ' . $teacher_slot -> from);
				 		$dt_teacher_to = new DateTime('2001-01-01 ' . $teacher_slot -> to);
				 		$dt_teacher_from_timestamp = $dt_teacher_from -> getTimestamp();
				 		$dt_teacher_to_timestamp = $dt_teacher_to -> getTimestamp();
				 		if ($dt_teacher_from_timestamp < $dt_start_timestamp && $dt_teacher_to_timestamp > $dt_end_timestamp) {
				 			$check = 1;
				 			break;
				 		}
				 	}
				 	if ($check == 0) {
				 		$message .= "Teacher is not available";
				 	}
				 	}*/
				 	//echo $message;

				 

				 	//if(strlen($string))

				 	for ($i = 0; $i < count($received_data['LessonRequest']['from']); $i++) {
				 		
				 		$received_data['LessonRequest']['from'][$i] = date("H:i", strtotime($received_data['LessonRequest']['from'][$i]));
				 		$received_data['LessonRequest']['to'][$i] = date("H:i", strtotime($received_data['LessonRequest']['to'][$i]));

						$date = getdate();
						$current_day_index = ($date['wday'] + 1) % 7;
						$received_day_index = $received_data['LessonRequest']['day'][$i];

				 		$initial_counter = $received_day_index - $current_day_index;
				 

				 		if ($initial_counter < 0)
				 			$initial_counter += 7;

				 		$day = $date['mday'];
				 		$year = $date['year'] + 1;
				 		$month = $date['mon'];

				 		$next_year_time = strtotime($year . "-" . $month . "-" . $day);
				 		$current_date = date("Y-m-d");
				 		//$current_time = strtotime($current_date);
				 		$current_time = strtotime($current_date . "+ " . $initial_counter . " days");
				 		$temp = new DateTime();
						$temp -> setTimestamp($current_time);
						$current_date = $temp -> format('Y-m-d');

				 		$counter = 7;
				 		$request -> start_date = $current_date;
				 		while ($current_time < $next_year_time) {
				 			$lesson = new Lesson;

				 			$id = $received_data['LessonRequest']['student_id'];

				 			$expected_date = new DateTime();
				 			$expected_date -> setTimestamp($current_time);

				 			$expected_start_time = $expected_date -> format('Y-m-d') . " " . $received_data['LessonRequest']['from'][$i];
				 			$expected_end_time = $expected_date -> format('Y-m-d') . " " . $received_data['LessonRequest']['to'][$i];

				 			$current_time = strtotime($current_date . "+ " . $counter . " days");
				 			$counter += 7;

				 			$lesson -> student_id = $id;
				 			$lesson -> teacher_id = $received_data['LessonRequest']['teacher_id'];
				 			$lesson -> expected_start_time = $expected_start_time;
				 			$lesson -> expected_end_time = $expected_end_time;
				 			$lesson -> cost = $received_data['LessonRequest']['cost'];
				 			$lesson -> currency_id = $received_data['LessonRequest']['currency'];
				 			$lesson -> lesson_type_id = $received_data['LessonRequest']['lesson-type'][$i];

				 			$lesson -> save();
				 		 }
						 $end = new DateTime();
						 $end -> setTimestamp($current_time);
						 $end_date = $end -> format('Y-m-d');
		
						 $request -> end_date = $end_date;

				 
				 	}
				 	$requestSlots = LessonRequestTimeSlot::model()->findAll('lesson_request_id = ' . $received_data['LessonRequest']['request_id']);
	
					for ($i = 0; $i < count($received_data['LessonRequest']['from']); $i++) {
						 $requestSlots[$i]->day = $received_data['LessonRequest']['day'][$i];
						 $requestSlots[$i]->from = $received_data['LessonRequest']['from'][$i];
						 $requestSlots[$i]->to = $received_data['LessonRequest']['to'][$i];
						 $requestSlots[$i]->save();
					}

					$request -> status = 1;
					$request -> save();
				 
				 	 
				 	if (strlen($message) < 1)
				 		$message = "Accepted Successfully";
				 	 	
					$transaction->commit(); 
				} catch (Exception $e) {
				 	$message = "Database error occured";
					$transaction -> rollBack();

					//echo "ERROR. please check your data again";
				}
				$result = LessonRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll("status = 0");
				$teachers = Teacher::model() -> findAll();
				$currencies = Currency::model() -> findAll();
				$this -> redirect('index.php?r=Requests/PendingRequests', array("result" => $result, "teachers" => $teachers, "my_message" => $message, "currencies" => $currencies));
			} else {
				$result = LessonRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll("status = 0");
				$teachers = Teacher::model() -> findAll();
				$currencies = Currency::model() -> findAll();

				$this -> render('PendingRequests', array("results" => $result, "teachers" => $teachers, "currencies" => $currencies));
			}

		} else {
			$this -> redirect('index.php?r=Calendar/CalendarView');
		}

	}

}
