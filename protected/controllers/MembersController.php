<?php

class MembersController extends Controller {
	public function actionIndex() {
		if (!isset(Yii::app() -> user -> id)) {
			$this -> redirect("index.php?r=DataModule/Login");
		}
		$this -> render('index');
	}

	
	
	
	public function actionShowStudentCalendar(){
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		if(Yii::app()->user->type == 'Admin'){
			$lessons = Lesson::model()->findAll("student_id = ".$_GET['id']);
			$this->render('/Calendar/calendarView',array("lessons"=>$lessons));
		}else{
		$this -> redirect("index.php?r=Calendar/calendarView");
		}
		
	}
	
	
	public function actionRemoveTeacher(){
		$id = $_GET['id'];
			
		$transaction = Yii::app() -> db -> beginTransaction();
		try{
			$user = Users::model()->find("profile_id = :id and type = 1",array(":id"=>$id));
			$user->delete();
		
			Lesson::model()->deleteAll("teacher_id = :id",array(":id"=>$id));
			$lesson_request_id = LessonRequest::model()->find("teacher_id = :id",array(":id"=>$id));
			if(count($lesson_request_id)){
			//	echo "HERE";
				$lesson_request_id->status = 0;
				$lesson_request_id->teacher_id = null;
				$lesson_request_id->save();
				$request_id = $lesson_request_id->id;
				LessonRequestTimeSlot::model()->deleteAll("lesson_request_id = :id",array(":id"=>$request_id));
		
			}
			
			TeacherTimeSlot::model()->deleteAll("teacher_id = :id",array(":id"=>$id));
			TeacherTypeBridge::model()->deleteAll("teacher_id = :id",array(":id"=>$id));
			
			$teacher = Teacher::model()->find("id = :id",array(":id"=>$id));
			$teacher->delete();
			
			$result = Teacher::model() -> with("teacherTimeSlots") -> findAll();
			$transaction->commit();
			//var_dump($result[0]->teacherTimeSlots);
			$this -> render('Teachers', array("results" => $result , "my_message"=>"Teacher removed successfully"));
		
		} catch (Exception $e) {

				$transaction -> rollBack();
				print_r($e);
		}
	}
	
	
	public function actionRemoveStudent(){
		$id = $_GET["id"];
		$transaction = Yii::app() -> db -> beginTransaction();
		try{
		$user = Users::model()->find("profile_id = :id and type = 0",array(":id"=>$id));
		$user->delete();
		
		Lesson::model()->deleteAll("student_id = :id",array(":id"=>$id));
		$lesson_request_id = LessonRequest::model()->find("student_id = :id",array(":id"=>$id));
		$request_id = $lesson_request_id->id;
		
		
		LessonRequestTimeSlot::model()->deleteAll("lesson_request_id = :id",array(":id"=>$request_id));
		
		
		
		
		$lesson_request_id->delete();
		
		$student = Student::model()->find("id = :id",array(":id"=>$id));
		$student->delete();
		
		
		
		
		$result = LessonRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll("status = 1");

		$teachers = Teacher::model() -> findAll();
		//var_dump($result[2]->lessonRequestTimeSlots);
		//var_dump($result[0]->lessonRequestTimeSlots[0]);
		
		$transaction->commit();
		$this -> render('Students', array("results" => $result, "teachers" => $teachers , "my_message"=>"User Removed Successfully"));
		
		} catch (Exception $e) {

				$transaction -> rollBack();
				print_r($e);
		}
		
	}
	public function actionShowTeacherCalendar(){
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		if(Yii::app()->user->type == 'Admin'){
			$lessons = Lesson::model()->findAll("teacher_id = ".$_GET['id']);
			$this->render('/Calendar/calendarView',array("lessons"=>$lessons));
		}else{
		$this -> redirect("index.php?r=Calendar/calendarView");
		}
		
	}
	
	
	
	public function actionEditStudent() {
		if (!isset(Yii::app() -> user -> id)) {
			$this -> redirect("index.php?r=DataModule/Login");
		}
		if (Yii::app() -> user -> type != "Admin") {
			$this -> redirect("index.php?r=Calendar/CalendarView");
		}

		if ($_POST) {
			if ($_POST['Student']['hear_us'] == 'Others') {
				$_POST['Student']['hear_us'] = $_POST['Student']['hear_us_others'];
			}
			
			$enable_edit = $_POST["edit"];

			//$_POST['Student']['age'] = $_POST['Student']['day'] . "-" . $_POST['Student']['month'] . "-" . $_POST['Student']['year'];
			$transaction = Yii::app() -> db -> beginTransaction();
			try {
				$model = Student::model()->find("id = :id",array(":id"=>$_POST['id']));
				
				$model -> attributes = $_POST['Student'];

				try {
					$message = "";
					
					for ($i = 0; $i < $enable_edit == 1 && $_POST['Student']['class_package'] && strlen($message) < 1 ; $i++) {
						$from_time = date("H:i", strtotime($_POST['Student']['prefered_from_' . ($i + 1)]));
						$to_time = date("H:i", strtotime($_POST['Student']['prefered_to_' . ($i + 1)]));
						$period = $_POST['Student']['prefered_lesson_period_' . ($i + 1)];
						$dt_start = new DateTime('2001-01-01 ' . $from_time);
						$dt_end = new DateTime('2001-01-1 ' . $to_time);
						$dt_start_timestamp = $dt_start -> getTimestamp();
						$dt_end_timestamp = $dt_end -> getTimestamp();
						if ($dt_end_timestamp < $dt_start_timestamp) {
							$message .= "Timeslot and interval are not equal";
						} else if (($dt_end_timestamp - $dt_start_timestamp) != ($period*60)) {
							$message .= "Timeslot and interval are not equal";
						}
						//echo $message;
						//echo $dt_start->getTimestamp()."<br>";
						//echo $dt_end->getTimestamp();
					}
					if (strlen($message) < 1 && $model -> save()) {
						$user = Users::model()->find("profile_id = :id and type = 0",array(":id"=>$_POST['id']));
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
							if($enable_edit == 0){
								$transaction -> commit();
								$id = $_POST['id'];
								$student = Student::model() -> find("id = :id", array(":id" => $id));
								$request = LessonRequest::model() -> find("student_id = :id", array("id" => $id));
								$slots = LessonRequestTimeSlot::model() -> findAll("lesson_request_id = :id", array(":id" => $request -> id));
								$countries = Countries::model() -> findAll();
								$this -> render("EditSpecificStudent", array("edit"=>$enable_edit, "id"=>$id,"student" => $student, "countries" => $countries, "slots" => $slots , "my_message" => "User data updated successfully" ));
								return;
							}
							$lesson_request = LessonRequest::model()->find("student_id = :id",array(":id"=>$_POST['id']));
							LessonRequestTimeSlot::model()->deleteAll("lesson_request_id = :lid",array("lid"=>$lesson_request->id));
							Lesson::model()->deleteAll("student_id = :id",array("id"=>$_POST['id']));
							
							//$lesson_request -> teacher_id = $_POST['Student']['teacher'];
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
									
									/*$date = getdate();
									$current_day_index = ($date['wday'] + 1) % 7;
									$received_day_index = $_POST['Student']['prefered_days_' . ($i + 1)];

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
							 		$lesson_request -> start_date = $current_date;
									while ($current_time < $next_year_time) {
							 			$lesson = new Lesson;
			
							 			$id = $_POST['id'];
			
							 			$expected_date = new DateTime();
							 			$expected_date -> setTimestamp($current_time);
			
							 			$expected_start_time = $expected_date -> format('Y-m-d') . " " . $from_time;
							 			$expected_end_time = $expected_date -> format('Y-m-d') . " " . $to_time;
			
							 			$current_time = strtotime($current_date . "+ " . $counter . " days");
							 			$counter += 7;
			
							 			$lesson -> student_id = $id;
							 			$lesson -> teacher_id = $lesson_request->teacher_id;
							 			$lesson -> expected_start_time = $expected_start_time;
							 			$lesson -> expected_end_time = $expected_end_time;
							 			$lesson -> cost = $lesson_request->cost;
							 			$lesson -> currency_id = $lesson_request->currency_id;
							 			$lesson -> lesson_type_id = $_POST['Student']['prefered_lesson_type_' . ($i + 1)];
			
							 			$lesson -> save();
							 		 }
										$end = new DateTime();
						 				$end -> setTimestamp($current_time);
										$end_date = $end -> format('Y-m-d');
						
										$lesson_request -> end_date = $end_date;
										$lesson_request -> status = 1;
										
									  
									 */
									 $lesson_request -> save();

									

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
						$message = "Updated successfully";
					}
					$transaction -> commit();
					
							
				} catch (Exception $e) {
					print_r($e);

					//echo "ERROR. please check your data again";
				}

			} catch (Exception $e) {

				$transaction -> rollBack();
				$message = "DB problem occured";
			}
			$id = $_POST['id'];
			$student = Student::model() -> find("id = :id", array(":id" => $id));
			$request = LessonRequest::model() -> find("student_id = :id", array("id" => $id));
			$slots = LessonRequestTimeSlot::model() -> findAll("lesson_request_id = :id", array(":id" => $request -> id));
			$countries = Countries::model() -> findAll();
			$this -> render("EditSpecificStudent", array("edit"=>$enable_edit,"id"=>$id,"student" => $student, "countries" => $countries, "slots" => $slots , "my_message" => $message ));
		} else {
			if(!isset($_GET['id']))return;
			$id = $_GET['id'];
			$student = Student::model() -> find("id = :id", array(":id" => $id));
			$request = LessonRequest::model() -> find("student_id = :id", array("id" => $id));
			$slots = LessonRequestTimeSlot::model() -> findAll("lesson_request_id = :id", array(":id" => $request -> id));
			$countries = Countries::model() -> findAll();
			$this -> render("EditSpecificStudent", array("student" => $student, "countries" => $countries, "slots" => $slots));
		}
	}

	public function actionEditTeacher(){
		if (!isset(Yii::app() -> user -> id)) {
			$this -> redirect("index.php?r=DataModule/Login");
		}
		if (Yii::app() -> user -> type != "Admin") {
			$this -> redirect("index.php?r=Calendar/CalendarView");
		}

		if ($_POST) {
			
			$model = Teacher::model()->find("id = :id",array(":id"=>$_POST["id"]));	
			//var_dump($_POST['Teacher']);
			$model -> attributes = $_POST['Teacher'];
			$transaction = Yii::app() -> db -> beginTransaction();
			try {
				
				
				//echo Yii::app() -> basePath . '\\images\\' . $model -> image;
				//$file -> saveAs(Yii::app() -> basePath . '\\..\\images\\' . $model -> image);
				try {
					$message = "";
				
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
								$message .= "Slot interval should be at least 30 minutes ";
								break;
							} else if (($dt_end_timestamp - $dt_start_timestamp) < 1800) {
								$message .= "Slot interval should be at least 30 minutes ";
								break;
							}
							$i++;
						}

					}

					if (strlen($message) < 1 && $model -> save()) {

						$user = Users::model()->find("profile_id = :id and type = 1",array(":id"=>$_POST["id"]));
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
							TeacherTimeSlot::model()->deleteAll("teacher_id = :id",array(":id"=>$_POST["id"]));
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

							TeacherTypeBridge::model()->deleteAll("teacher_id = :id",array(":id"=>$_POST["id"]));
							
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
				$transaction -> rollBack();
				$message = "DB error";
			}

			if (strlen($message) < 1)
				$message = "Updated Successfully";
			$id = $_POST['id'];
			$teacher = Teacher::model() -> find("id = :id", array(":id" => $id));
			$slots = TeacherTimeSlot::model() -> findAll("teacher_id = :id", array(":id" => $id));
			$countries = Countries::model() -> findAll();
			$lessons = LessonType::model()->findAll();
			$selected_lessons = TeacherTypeBridge::model()->findAll("teacher_id = :id", array(":id" => $id));
			$this -> render("EditSpecificTeacher", array("id"=>$id, "teacher" => $teacher, "countries" => $countries, "slots" => $slots , "lessons"=>$lessons , "selected_lessons"=>$selected_lessons , "my_message"=>$message));
				
			} else {

			$id = $_GET['id'];
			$teacher = Teacher::model() -> find("id = :id", array(":id" => $id));
			$slots = TeacherTimeSlot::model() -> findAll("teacher_id = :id", array(":id" => $id));
			$countries = Countries::model() -> findAll();
			$lessons = LessonType::model()->findAll();
			$selected_lessons = TeacherTypeBridge::model()->findAll("teacher_id = :id", array(":id" => $id));
			$this -> render("EditSpecificTeacher", array("teacher" => $teacher, "countries" => $countries, "slots" => $slots , "lessons"=>$lessons , "selected_lessons"=>$selected_lessons));
		}
		
	}

	public function actionStudents() {

		if (!isset(Yii::app() -> user -> id)) {
			$this -> redirect("index.php?r=DataModule/Login");
		}

		if (Yii::app() -> user -> type == "Student") {
			$this -> redirect("index.php?r=Calendar/CalendarView");
		}
		$result = LessonRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll("status = 1");

		$teachers = Teacher::model() -> findAll();
		//var_dump($result[2]->lessonRequestTimeSlots);
		//var_dump($result[0]->lessonRequestTimeSlots[0]);
		$this -> render('Students', array("results" => $result, "teachers" => $teachers));
	}
	
	public function actionTeachers() {
		if (!isset(Yii::app() -> user -> id)) {
			$this -> redirect("index.php?r=DataModule/Login");
		}
	
		if (Yii::app() -> user -> type != "Admin") {
			$this -> redirect("index.php?r=Calendar/CalendarView");
		}
	
		$result = Teacher::model() -> with("teacherTimeSlots") -> findAll();
		//var_dump($result[0]->teacherTimeSlots);
		$this -> render('Teachers', array("results" => $result));
	}
	

}
