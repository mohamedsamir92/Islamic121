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
		//$allTeachers = Teacher::model() -> findAll();
		$countries = Countries::model() -> findAll();

		if (isset($_POST['Student'])) {

			if ($_POST['Student']['hear_us'] == 'Others') {
				$_POST['Student']['hear_us'] = $_POST['Student']['hear_us_others'];
			}

			//$_POST['Student']['age'] = $_POST['Student']['day'] . "-" . $_POST['Student']['month'] . "-" . $_POST['Student']['year'];
			$transaction = Yii::app() -> db -> beginTransaction();
			try {
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
					} else {
						$username_exist_check = Users::model() -> find("username = :uname", array(":uname" => $_POST['Student']['username']));
						if (count($username_exist_check) > 0)
							$message = "username is already exist";
					}
					for ($i = 0; $i < $_POST['Student']['class_package'] && strlen($message) < 1; $i++) {
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
						$user = new Users;
						$user -> username = $_POST['Student']['username'];
						$user -> type = 0;
						$user -> profile_id = $model -> id;
						if (!$user -> save()) {
							foreach ($user->getErrors() as $key => $value) {
								foreach ($value as $error) {
									$message .= $error . " ";
								}
							}
						} else {
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
									$lesson_time_slots -> lesson_type = $_POST['Student']['prefered_lesson_type_' . ($i + 1)];
									$lesson_time_slots -> period = $_POST['Student']['prefered_lesson_period_' . ($i + 1)];

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
								//Student::model() -> deleteAll("id = " . $model -> id);
							}
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
					$transaction -> commit();
					$this -> layout = 'registration';
					$this -> render('AddStudent', array("my_message" => $message, "countries" => $countries));

				} catch (Exception $e) {
					print_r($e);

					//echo "ERROR. please check your data again";
				}

			} catch (Exception $e) {

				$transaction -> rollBack();
				$this -> render("AddStudent", array("countries" => $countries, "my_message" => "Failure"));
			}
		} else {
			$this -> layout = 'registration';
			$this -> render('AddStudent', array("countries" => $countries));

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

	public function actionCheckTeacherSlot() {
		$from_time = date("H:i", strtotime($_GET['from']));
		$to_time = date("H:i", strtotime($_GET['to']));
		$dt_start = new DateTime('2001-01-01 ' . $from_time);
		$dt_end = new DateTime('2001-01-1 ' . $to_time);
		$dt_start_timestamp = $dt_start -> getTimestamp();
		$dt_end_timestamp = $dt_end -> getTimestamp();
		$result = array();
		if ($dt_end_timestamp < $dt_start_timestamp) {
			$result["status"] = "Slot interval should be at least 30 minutes";
		} else if (($dt_end_timestamp - $dt_start_timestamp) < 1800) {
			$result["status"] = "Slot interval should be at least 30 minutes";
		}
		else{
			$result["status"] = "OK";
		}
		echo json_encode($result);
	}

	public function actionAddTeacher() {
		$model = new Teacher;
		$message = "";
		$countries = Countries::model() -> findAll();
		$lessons = LessonType::model() -> findAll();
		if (isset($_POST['Teacher'])) {
			//var_dump($_POST['Teacher']);
			$model -> attributes = $_POST['Teacher'];
			$transaction = Yii::app() -> db -> beginTransaction();
			try {
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
					} else {
						$username_exist_check = Users::model() -> find("username = :uname", array(":uname" => $_POST['Teacher']['username']));
						if (count($username_exist_check) > 0)
							$message = "username is already exist";
					}

					$i = 0;

					if (!isset($_POST['Teacher']['days']))
						$message = "You must register working hours";
					else {

						foreach ($_POST['Teacher']['days'] as $dayIndex) {
							$from_time = date("H:i", strtotime($_POST['Teacher']['from'][$i]));
							$to_time = date("H:i", strtotime($_POST['Teacher']['to'][$i]));
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

						$user = new Users;
						$user -> username = $_POST['Teacher']['username'];
						$user -> type = 1;
						$user -> profile_id = $model -> id;
						if (!$user -> save()) {
							foreach ($user->getErrors() as $key => $value) {
								foreach ($value as $error) {
									$message .= $error . " ";
								}

							}
						} else {
							$index = 0;
							foreach ($_POST['Teacher']['days'] as $dayIndex) {
								$from_time = date("H:i", strtotime($_POST['Teacher']['from'][$index]));
								$to_time = date("H:i", strtotime($_POST['Teacher']['to'][$index]));

								$slot = new TeacherTimeSlot;
								$slot -> teacher_id = $model -> id;
								$slot -> day = $dayIndex;
								$slot -> from = $from_time;
								$slot -> to = $to_time;
								$slot -> save();
								$index++;

							}

							foreach ($_POST['Teacher']['lesson'] as $lessons_type) {
								$teacherTypeBridge = new TeacherTypeBridge;
								$teacherTypeBridge -> teacher_id = $model -> id;
								$teacherTypeBridge -> type_id = $lessons_type;
								$teacherTypeBridge -> save();
							}
							
						}

					} else {

						foreach ($model->getErrors() as $key => $value) {
							foreach ($value as $error) {
								$message .= $error . " ";
							}
						}

					}
					$transaction -> commit();
				} catch (Exception $e) {
					print_r($e);

				}
			} catch (Exception $e) {
				print_r($e);
				$transaction -> rollBack();
				$this -> render('AddTeacher', array("countries" => $countries, "lessons" => $lessons, "my_message" => $message));
			}

			if (strlen($message) < 1)
				$message = "Registered Successfully";
			if (isset(Yii::app() -> user -> id)) {
				if (Yii::app() -> user -> type == 'Admin')
					$this -> render('AddTeacher', array("countries" => $countries, "lessons" => $lessons, "my_message" => $message));
				else
					$this -> redirect('index.php?r=DataModule/Login', array("my_message" => $message));
			} else
				$this -> redirect('index.php?r=DataModule/Login', array("my_message" => $message));
		} else {
			if (isset(Yii::app() -> user -> id)) {
				if (Yii::app() -> user -> type == 'Admin')
					$this -> render('AddTeacher', array("countries" => $countries, "lessons" => $lessons));
				else
					$this -> redirect('index.php?r=DataModule/Login');
			} else
				$this -> redirect('index.php?r=DataModule/Login');
		}
	}

	public function actionCheckCurrency() {
		$currency_id = $_GET['currency_id'];
		$uname = $_GET['uname'];
		$check = Users::model() -> find("username = :uname and currency_id = :id", array(":uname" => $uname, ":id" => $currency_id));
		if (count($check) > 0)
			$result['status'] = "ok";
		else
			$result['status'] = "failed";

		echo json_encode($result);
	}

	public function actionCheckStudentUsername() {
		$uname = $_GET['uname'];
		$check = Users::model() -> find("username = :uname", array(":uname" => $uname));
		$result = array();
		if (count($check) > 0)
			$result['status'] = "failed";
		else
			$result['status'] = "ok";

		echo json_encode($result);
	}

	public function actionCheckStudentUsernameExistence() {
		$uname = $_GET['uname'];
		$check = Users::model() -> find("username = :uname", array(":uname" => $uname));
		$result = array();
		if (count($check) == 0)
			$result['status'] = "failed";
		else
			$result['status'] = "ok";

		echo json_encode($result);
	}

	public function actionCheckStudentEmail() {
		$email = $_GET['email'];
		$check = Student::model() -> find("email = :email", array(":email" => $email));
		$result = array();
		if (count($check) > 0)
			$result['status'] = "failed";
		else
			$result['status'] = "ok";

		echo json_encode($result);
	}

	public function actionCheckSlot() {
		$message = "";
		$message = "";
		$period = $_GET['period'];
		$gender = $_GET['gender'];
		$day = $_GET['day'];
		$type = $_GET['type'];
		$from_time = date("H:i", strtotime($_GET['from']));
		$to_time = date("H:i", strtotime($_GET['to']));
		$dt_start = new DateTime('2001-01-01 ' . $from_time);
		$dt_end = new DateTime('2001-01-1 ' . $to_time);
		$dt_start_timestamp = $dt_start -> getTimestamp();
		$dt_end_timestamp = $dt_end -> getTimestamp();
		//echo ($dt_end_timestamp - $dt_start_timestamp) . " " . ($period*60);

		if ($dt_end_timestamp < $dt_start_timestamp) {
			$message .= " Time interval isn't equal to period time";
		} else if (($dt_end_timestamp - $dt_start_timestamp) != ($period * 60)) {
			$message .= " Time interval isn't equal to period time";
		}

		$check = 0;
		$slots = ValidationRules::model() -> findAll("day = :day and gender = :gender and lesson_type = :type", array(":day" => $day, ":gender" => $gender, ":type" => $type));
		$times = "";
		if (count($slots) == 0)
			$message = " No Available slots";
		else {
			foreach ($slots as $slot) {
				$dt_slot_from = new DateTime('2001-01-01 ' . $slot -> from);
				$dt_slot_to = new DateTime('2001-01-01 ' . $slot -> to);
				$times .= "from " . $slot -> from . " to " . $slot -> to . ". ";
				$dt_slot_from_timestamp = $dt_slot_from -> getTimestamp();
				$dt_slot_to_timestamp = $dt_slot_to -> getTimestamp();
				if ($dt_slot_from_timestamp <= $dt_start_timestamp && $dt_slot_to_timestamp >= $dt_end_timestamp) {
					$check = 1;
					break;
				}
			}
		}
		/*$teacher_slots = TeacherTimeSlot::model() -> findAll();
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
		 }*/
		if ($check == 0) {
			if (strlen($message) < 1)
				$message = " These times are not available, Available times are " . $times;
		}
		if (strlen($message) < 1)
			$message = "Success";
		$result = array();
		$result["status"] = $message;
		echo json_encode($result);

	}

	public function actionAddAdmin() {
		$model = new Admin;

		if (isset($_POST['Admin'])) {
			$message = "";
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
			$username_exist_check = Users::model() -> find("username = :uname", array(":uname" => $_POST['Admin']['username']));
			if (count($username_exist_check) > 0)
				$message = "username is already exist";
			if (strlen($message) < 1 && $model -> save()) {
				$user = new Users;
				$user -> username = $_POST['Admin']['username'];
				$user -> type = 2;
				$user -> profile_id = $model -> id;
				$user -> save();
				if (isset(Yii::app() -> user -> id)) {
					if (Yii::app() -> user -> type == 'Admin')
						$this -> render('AddAdmin');
					else
						$this -> redirect('index.php?r=DataModule/Login');
				} else
					$this -> redirect('index.php?r=DataModule/Login');

			} else
				print_r($model -> getErrors());
			//var_dump($_FILES);
			//$target_file = $target_dir . basename($_FILES["image"]["name"]);
			//$uploadOk = 1;
			//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			//echo $imageFileType;

		} else {
			if (Yii::app() -> user -> type == 'Admin')
				$this -> render('AddAdmin');

		}

	}

	public static function getTeacher($id){
		$teacher = Teacher::model()->find("id = :id",array(":id"=>$id));
		return $teacher;
	}
	
	public static function getStudent($id){
		$student = Student::model()->find("id = :id",array(":id"=>$id));
		return $student;
	}
	
	public function actionGetRegions() {
		$id = $_GET['id'];
		$cities = Regions::model() -> findAll("country_id = :id", array(":id" => $id));
		$return = array();
		$i = 0;
		foreach ($cities as $city) {
			$return[] = array();
			$return[$i]["id"] = $city -> id;
			$return[$i]["name"] = $city -> name;
			$i++;
		}

		echo json_encode($return);
	}

	public function actionGetSlots() {
		$gender = $_GET['gender'];
		$type = $_GET['type'];

		$preferences = ValidationRules::model() -> findAll("lesson_type = :type and gender = :gender", array(":type" => $type, ":gender" => $gender));
		$i = 0;
		$return = array();
		$days = array();
		foreach ($preferences as $pref) {
			$days[] = $pref -> day;
		}
		$return["days"] = $days;
		echo json_encode($return);
	}

}
