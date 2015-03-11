<?php

class DataModuleController extends Controller {
	public function actionIndex() {
		$this -> render('index');
	}

	public function actionError() {
		echo "Ya 7amar";
	}

	public function actionLogin() {
		if (isset(Yii::app() -> user -> id)) {
			$this -> redirect('index.php?r=Calendar/CalendarView');
		}
		if (isset($_POST['Login'])) {
			//var_dump($_POST);
			$identity = new UserIdentity($_POST['Login']['username'], $_POST['Login']['password']);
			$identity -> setType($_POST['Login']['type']);
			//var_dump($identity);
			$message = "Registered Successfully";
			if ($identity -> authenticate()) {
				Yii::app() -> user -> login($identity);
				$_type = Yii::app() -> user -> type;
				if ($_type == "Student")
					$this -> redirect('index.php?r=Calendar/CalendarView');
				else if ($_type == "Admin")
					$this -> redirect('index.php?r=DashBoard/AdminDashBoard');
				else if ($_type == "Teacher")
					$this -> redirect('index.php?r=Calendar/CalendarView');

			} else {
				//echo $identity -> errorMessage;
				//echo "ERROR";
				$message = "Username or password incorrect";
				//	echo "string";
			}
			$this -> render('Login', array("my_message" => $message));

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
			$_POST['Student']['age'] = $_POST['Student']['day']."-".$_POST['Student']['month']."-".$_POST['Student']['year'];
		
			$model -> attributes = $_POST['Student'];

			if (strlen($_FILES['Student']['name']['image']) > 0) {

				$file = CUploadedFile::getInstance($model, 'image');
				//var_dump($file);

				$fileName = date('YmdHms') + $model -> image;
				// random number + file name
				$model -> image = $fileName . '.' . $file -> getExtensionName();
				//echo $model->image;

				//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
				$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $model -> image);
			} else {
				$model -> image = "no-image.jpg";
			}
			$model -> password = $model -> hashPassword($model -> password);
			try {
				$message = "";
				if ($_POST['Student']['confirmed_password'] != $_POST['Student']['password']) {
					$message = "Your passwords don\'t match, please try again. ";
				}
				for ($i = 0; $i < $_POST['Student']['class_package']; $i++) {
					$from_time = date("H:i", strtotime($_POST['Student']['prefered_from_' . ($i + 1)]));
					$to_time = date("H:i", strtotime($_POST['Student']['prefered_to_' . ($i + 1)]));
					$dt_start = new DateTime('2001-01-01 ' . $from_time);
					$dt_end = new DateTime('2001-01-1 ' . $to_time);
					$dt_start_timestamp = $dt_start -> getTimestamp();
					$dt_end_timestamp = $dt_end -> getTimestamp();
					if ($dt_end_timestamp < $dt_start_timestamp) {
						$message .= "Error in slot number " . ($i + 1) . ", slot interval should be only 30 minutes or 1 hour";
					} else if (($dt_end_timestamp - $dt_start_timestamp) != 1800 && ($dt_end_timestamp - $dt_start_timestamp) != 3600) {
						$message .= "Error in slot number " . ($i + 1) . ", slot interval should be only 30 minutes or 1 hour";
					}
					//echo $message;
					//echo $dt_start->getTimestamp()."<br>";
					//echo $dt_end->getTimestamp();
				}
				if (strlen($message) < 1 && $model -> save()) {
					$lesson_request = new LessonRequest;
					$lesson_request -> student_id = $model -> id;
					//$lesson_request -> teacher_id = $_POST['Student']['teacher'];
					if ($lesson_request -> save()) {
						for ($i = 0; $i < $_POST['Student']['class_package']; $i++) {
							$from_time = date("H:i", strtotime($_POST['Student']['prefered_from_' . ($i + 1)]));
							$to_time = date("H:i", strtotime($_POST['Student']['prefered_to_' . ($i + 1)]));

							$lesson_time_slots = new LessonRequestTimeSlot;
							$lesson_time_slots -> lesson_request_id = $lesson_request -> id;

							$lesson_time_slots -> day = $_POST['Student']['prefered_days_' . ($i + 1)];
							$lesson_time_slots -> from = $from_time;
							$lesson_time_slots -> to = $to_time;
							$lesson_time_slots -> save();
							//print_r($lesson_time_slots -> getErrors());

						}
					} else {
						//var_dump($lesson_request->getErrors());
						foreach ($lesson_request->getErrors() as $key => $value) {
							foreach ($value as $error) {
								$message .= $error . " ";
							}
						}
						Student::model() -> deleteAll("id = " . $model -> id);
					}
				} else {

					//var_dump($model->getErrors());
					foreach ($model->getErrors() as $key => $value) {
						foreach ($value as $error) {
							$message .= $error . " ";
						}

					}

					//return;

				}
				//echo $message;
				if (strlen($message) < 1) {
					$message = "Registered successfully";
				}
				$this -> layout = 'registration';
				$this -> render('AddStudent', array("teachers" => $allTeachers, "my_message" => $message));

			} catch (Exception $e) {
				print_r($e);

				//echo "ERROR. please check your data again";
			}

			//var_dump($_FILES);
			//$target_file = $target_dir . basename($_FILES["image"]["name"]);
			//$uploadOk = 1;
			//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			//echo $imageFileType;

		} else {
			$this -> layout = 'registration';
			$this -> render('AddStudent', array("teachers" => $allTeachers));

		}

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
		$message = "";
		if (isset($_POST['Teacher'])) {
			//var_dump($_POST['Teacher']);
			$model -> attributes = $_POST['Teacher'];
			//
			//$target_dir = Yii::app() -> request -> baseUrl . "/images/";

			if (isset($_POST['Teacher']['image'])) {
				$file = CUploadedFile::getInstance($model, 'image');
				//var_dump($file);

				$fileName = date('YmdHms') + $model -> image;
				// random number + file name
				$model -> image = $fileName . '.' . $file -> getExtensionName();
				//echo $model->image;

				//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
				$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $model -> image);
			} else {
				$model -> image = "no-image.jpg";
			}
			//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
			//$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $model -> image);
			$model -> password = $model -> hashPassword($model -> password);
			try {
				$message = "";
				if ($_POST['Teacher']['confirmed_password'] != $_POST['Teacher']['password']) {
					$message = "Your passwords don\'t match, please try again. ";
				}
				$i = 0;
				if (!isset($_POST['Teacher']['days']))
					$message = "You must register working hours";
				else {
					foreach ($_POST['Teacher']['days'] as $dayIndex) {
						$from_time = date("H:i", strtotime($_POST['Teacher']['from'][$dayIndex]));
						$to_time = date("H:i", strtotime($_POST['Teacher']['to'][$dayIndex]));
						$dt_start = new DateTime('2001-01-01 ' . $from_time);
						$dt_end = new DateTime('2001-01-1 ' . $to_time);
						$dt_start_timestamp = $dt_start -> getTimestamp();
						$dt_end_timestamp = $dt_end -> getTimestamp();
						if ($dt_end_timestamp < $dt_start_timestamp) {
							$message .= "Error in time number " . ($i + 1) . ", slot interval should be at least 30 minutes ";
						} else if (($dt_end_timestamp - $dt_start_timestamp) < 1800) {
							$message .= "Error in time number " . ($i + 1) . ", slot interval should be at least 30 minutes ";
						}
						$i++;
					}
				}

				if (strlen($message) < 1 && $model -> save()) {

					foreach ($_POST['Teacher']['days'] as $dayIndex) {
						$from_time = date("H:i", strtotime($_POST['Teacher']['from'][$dayIndex]));
						$to_time = date("H:i", strtotime($_POST['Teacher']['to'][$dayIndex]));

						$slot = new TeacherTimeSlot;
						$slot -> teacher_id = $model -> id;
						$slot -> day = $dayIndex;
						$slot -> from = $from_time;
						$slot -> to = $to_time;
						$slot -> save();

					}

				} else {

					foreach ($model->getErrors() as $key => $value) {
						foreach ($value as $error) {
							$message .= $error . " ";
						}
					}

				}

			} catch (Exception $e) {
				print_r($e);

				//echo "ERROR. please check your data again";
			}

			//print_r($model -> getErrors());
			//var_dump($_FILES);
			//$target_file = $target_dir . basename($_FILES["image"]["name"]);
			//$uploadOk = 1;
			//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			//echo $imageFileType;
			if (strlen($message) < 1)
				$message = "Registered Successfully";
			if (isset(Yii::app() -> user -> id)) {
				if (Yii::app() -> user -> type == 'Admin')
					$this -> render('AddTeacher', array("my_message" => $message));
				else
					$this -> redirect('index.php?r=DataModule/Login', array("my_message" => $message));
			} else
				$this -> redirect('index.php?r=DataModule/Login', array("my_message" => $message));
		} else {
			if (isset(Yii::app() -> user -> id)) {
				if (Yii::app() -> user -> type == 'Admin')
					$this -> render('AddTeacher');
				else
					$this -> redirect('index.php?r=DataModule/Login');
			} else
				$this -> redirect('index.php?r=DataModule/Login');
		}
	}


	public function actionCheckStudentUsername(){
		$uname = $_GET['uname'];
		$check = Student::model()->find("username = :uname",array(":uname"=>$uname));
		$result = array();
		if(count($check) > 0)
			$result['status'] = "failed";
		else 
			$result['status'] = "ok";
		
		echo json_encode($result);
	}
	public function actionCheckStudentEmail(){
		$email = $_GET['email'];
		$check = Student::model()->find("email = :email",array(":email"=>$email));
		$result = array();
		if(count($check) > 0)
			$result['status'] = "failed";
		else 
			$result['status'] = "ok";
		
		echo json_encode($result);
	}
	
	public function actionCheckSlot() {
		$message = "";
		$message = "";
		$from_time = date("H:i", strtotime($_GET['from']));
		$to_time = date("H:i", strtotime($_GET['to']));
		$dt_start = new DateTime('2001-01-01 ' . $from_time);
		$dt_end = new DateTime('2001-01-1 ' . $to_time);
		$dt_start_timestamp = $dt_start -> getTimestamp();
		$dt_end_timestamp = $dt_end -> getTimestamp();
		if ($dt_end_timestamp < $dt_start_timestamp) {
			$message .= "Error in this slot , slot interval should be only 30 minutes or 1 hour";
		} else if (($dt_end_timestamp - $dt_start_timestamp) != 1800 && ($dt_end_timestamp - $dt_start_timestamp) != 3600) {
			$message .= "Error in this slot , slot interval should be only 30 minutes or 1 hour";
		}

		$teacher_slots = TeacherTimeSlot::model() -> findAll();
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
		/*if ($check == 0) {
			$message .= "Teacher is not available";
		}*/
		if(strlen($message) < 1)
			$message = "Success";
		$result = array();
		$result["status"] = $message;
		echo json_encode($result);

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
		if (isset(Yii::app() -> user -> id)) {
			if (Yii::app() -> user -> type == 'Admin')
				$this -> render('AddAdmin');
			else
				$this -> redirect('index.php?r=DataModule/Login');
		} else
			$this -> redirect('index.php?r=DataModule/Login');

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
