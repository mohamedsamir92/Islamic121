<?php

class EditController extends Controller {
	public function actionIndex() {
		$this -> render('index');
	}

	public function actionEditAdmin() {
		$record = Admin::model() -> find("id = " . Yii::app() -> user -> id);

		if (isset($_POST["Admin"])) {
			//var_dump($_POST["Teacher"]);
			//var_dump($_POST);

			$record -> attributes = $_POST['Admin'];
			//
			//$target_dir = Yii::app() -> request -> baseUrl . "/images/";

			$file = CUploadedFile::getInstance($record, 'image');

			//var_dump($file);
			if ($file != NULL) {
				if (file_exists(Yii::app() -> basePath . '\\..\\images\\' . $record -> image)) {
					//echo "Exist";
					//echo $record -> image;
					unlink(Yii::app() -> basePath . '\\..\\images\\' . $record -> image);

				}
				$fileName = date('YmdHms');
				// random number + file name
				$record -> image = $fileName . '.' . $file -> getExtensionName();
				//echo $record -> image;

				//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
				$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $record -> image);
			}
			if ($record -> save()) {
				$identity = new UserIdentity($record->username ,  $record->password);
				$identity -> setType(Yii::app()->user->type);
				//var_dump($identity);

				if ($identity -> update()) {
					//Yii::app() -> user -> logout();
				
					Yii::app() -> user -> login($identity);
				}

			}
			$this -> redirect("index.php?r=Preview/Preview" . Yii::app() -> user -> type);
		} else
			$this -> render('EditAdmin');

	}

	public function actionEditStudent() {
		$record = Student::model() -> find("id = " . Yii::app() -> user -> id);

		if (isset($_POST["Student"])) {
			//var_dump($_POST["Student"]);
			//var_dump($_POST);

			$record -> attributes = $_POST['Student'];
			//
			//$target_dir = Yii::app() -> request -> baseUrl . "/images/";

			$file = CUploadedFile::getInstance($record, 'image');

			//var_dump($file);
			if ($file != NULL) {
				if (file_exists(Yii::app() -> basePath . '\\..\\images\\' . $record -> image)) {
					//echo "Exist";
					//echo $record -> image;
					unlink(Yii::app() -> basePath . '\\..\\images\\' . $record -> image);

				}
				$fileName = date('YmdHms');
				// random number + file name
				$record -> image = $fileName . '.' . $file -> getExtensionName();
				//echo $record -> image;

				//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
				$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $record -> image);
			}
			if ($record -> save()) {
				$identity = new UserIdentity($record->username ,  $record->password);
				$identity -> setType(Yii::app()->user->type);
				//var_dump($identity);

				if ($identity -> update()) {
					//Yii::app() -> user -> logout();
				
					Yii::app() -> user -> login($identity);
				}

			}
			//print_r($record -> getErrors());
			$this -> redirect("index.php?r=Preview/Preview" . Yii::app() -> user -> type);
		} else
			$this -> render('EditStudent', array("Guardian" => $record -> guardians_name));
	}

	public function actionEditTeacher() {
		$record = Teacher::model() -> find("id = " . Yii::app() -> user -> id);

		if (isset($_POST["Teacher"])) {
			//var_dump($_POST["Teacher"]);
			//var_dump($_POST);

			$record -> attributes = $_POST['Teacher'];
			//
			//$target_dir = Yii::app() -> request -> baseUrl . "/images/";

			$file = CUploadedFile::getInstance($record, 'image');

			//var_dump($file);
			if ($file != NULL) {
				if (file_exists(Yii::app() -> basePath . '\\..\\images\\' . $record -> image)) {
					//echo "Exist";
					//echo $record -> image;
					unlink(Yii::app() -> basePath . '\\..\\images\\' . $record -> image);

				}
				$fileName = date('YmdHms');
				// random number + file name
				$record -> image = $fileName . '.' . $file -> getExtensionName();
				//echo $record -> image;

				//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
				$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $record -> image);
			}
			if ($record -> save()) {
				$identity = new UserIdentity($record->username ,  $record->password);
				$identity -> setType(Yii::app()->user->type);
				//var_dump($identity);

				if ($identity -> update()) {
					//Yii::app() -> user -> logout();
				
					Yii::app() -> user -> login($identity);
				}

			}
			print_r($record -> getErrors());
			$this -> redirect("index.php?r=Preview/Preview" . Yii::app() -> user -> type);
		} else
			$this -> render('EditTeacher');

	}

}
