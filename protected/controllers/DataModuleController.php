<?php

class DataModuleController extends Controller {
	public function actionIndex() {
		$this -> render('index');
	}

	public function actionLogin() {

		if (isset($_POST['Login'])) {
			//var_dump($_POST);
			$identity = new UserIdentity($_POST['Login']['username'], $_POST['Login']['password']);
			$identity -> setType($_POST['Login']['type']);
			//var_dump($identity);

			if ($identity -> authenticate()) {
				Yii::app() -> user -> login($identity);
				$_type = Yii::app() -> user -> type;
				if ($_type == "Student")
					$this -> redirect('index.php?r=DashBoard/StudentDashBoard');
				else if ($_type == "Admin")
					$this -> redirect('index.php?r=DashBoard/AdminDashBoard');
				else if ($_type == "Teacher")
					$this -> redirect('index.php?r=DashBoard/TeacherDashBoard');

			} else {
				echo $identity -> errorMessage;
				echo "ERROR";
				//	echo "string";
			}

		} else
			$this -> render('Login');
	}

	public function actionLogout() {
		Yii::app() -> user -> logout();
		$this -> redirect('index.php?r=DataModule/Login');
	}

	public function actionAddStudent() {
		$model = new Student;
		$allTeachers = Teacher::model() -> findAll();

		if (isset($_POST['Student'])) {
			var_dump($_POST['Student']);
			$model -> attributes = $_POST['Student'];
			//
			//$target_dir = Yii::app() -> request -> baseUrl . "/images/";

			$file = CUploadedFile::getInstance($model, 'image');
			//var_dump($file);

			$fileName = date('YmdHms') + $model -> image;
			// random number + file name
			$model -> image = $fileName . '.' . $file -> getExtensionName();
			//echo $model->image;

			//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
			$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $model -> image);
			$model -> password = $model -> hashPassword($model -> password);
			if ($model -> save()) {
				$lesson_request = new LessonsRequest;
				$lesson_request -> student_id = $model -> id;
				$lesson_request -> teacher_id = $_POST['Student']['teacher'];
				if ($lesson_request -> save()) {
					for ($i = 0; $i < $_POST['Student']['class_package']; $i++) {
						$lesson_time_slots = new LessonRequestTimeSlot;
						$lesson_time_slots -> lesson_request_id = $lesson_request -> id;

						$lesson_time_slots -> day = $_POST['Student']['prefered_days_' . ($i + 1)];
						$lesson_time_slots -> from = $_POST['Student']['prefered_from_' . ($i + 1)];
						$lesson_time_slots -> to = $_POST['Student']['prefered_to_' . ($i + 1)];
						$lesson_time_slots -> save();
						//print_r($lesson_time_slots -> getErrors());

					}

				}
			} else {
				print_r($model -> getErrors());

			}
			//var_dump($_FILES);
			//$target_file = $target_dir . basename($_FILES["image"]["name"]);
			//$uploadOk = 1;
			//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			//echo $imageFileType;

		}
		$this -> render('AddStudent', array("teachers" => $allTeachers));

	}

	public function actionGetTeacherTimeSlots() {
		if (isset($_GET['day']))
			$teacherSlots = TeacherTimeSlot::model() -> findAll("teacher_id = :id and day = :day", array(":id" => $_GET['id'], ":day" => $_GET['day']));
		else 
			$teacherSlots = TeacherTimeSlot::model() -> findAll("teacher_id = :id", array(":id" => $_GET['id']));
		$result = array();
		foreach ($teacherSlots as $slot) {
			$result[] = array("day" => $slot -> day, "from" => $slot -> from, "to" => $slot -> to);
		}
		//var_dump($teacher);
		echo json_encode($result);
	}

	public function actionAddTeacher() {
		$model = new Teacher;

		if (isset($_POST['Teacher'])) {
			//var_dump($_POST['Student']);
			$model -> attributes = $_POST['Teacher'];
			//
			//$target_dir = Yii::app() -> request -> baseUrl . "/images/";

			$file = CUploadedFile::getInstance($model, 'image');
			//var_dump($file);

			$fileName = date('YmdHms') + $model -> image;
			// random number + file name
			$model -> image = $fileName . '.' . $file -> getExtensionName();
			//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
			$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $model -> image);
			$model -> password = $model -> hashPassword($model -> password);
			$model -> save();
			print_r($model -> getErrors());
			//var_dump($_FILES);
			//$target_file = $target_dir . basename($_FILES["image"]["name"]);
			//$uploadOk = 1;
			//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			//echo $imageFileType;

		}
		$this -> render('AddTeacher');

	}

	public function actionAddAdmin() {
		$model = new Admin;

		if (isset($_POST['Admin'])) {
			//var_dump($_POST['Student']);
			$model -> attributes = $_POST['Admin'];
			//
			//$target_dir = Yii::app() -> request -> baseUrl . "/images/";

			$file = CUploadedFile::getInstance($model, 'image');
			//var_dump($file);

			$fileName = date('YmdHms') + $model -> image;
			// random number + file name
			$model -> image = $fileName . '.' . $file -> getExtensionName();
			//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
			$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $model -> image);
			$model -> password = $model -> hashPassword($model -> password);
			$model -> save();
			print_r($model -> getErrors());
			//var_dump($_FILES);
			//$target_file = $target_dir . basename($_FILES["image"]["name"]);
			//$uploadOk = 1;
			//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			//echo $imageFileType;

		}
		$this -> render('AddAdmin');

	}

	// Uncomment the following methods and override them if needed
	/*
	 public function filters()
	 {
	 // return the filter configuration for this controller, e.g.:
	 return array(
	 'inlineFilterName',
	 array(
	 'class'=>'path.to.FilterClass',
	 'propertyName'=>'propertyValue',
	 ),
	 );
	 }

	 public function actions()
	 {
	 // return external action classes, e.g.:
	 return array(
	 'action1'=>'path.to.ActionClass',
	 'action2'=>array(
	 'class'=>'path.to.AnotherActionClass',
	 'propertyName'=>'propertyValue',
	 ),
	 );
	 }
	 */
}
