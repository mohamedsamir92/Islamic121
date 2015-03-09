<?php

class RequestsController extends Controller {
	public function actionIndex() {
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		$this -> render('index');
	}

	function getWeekDay($day, $month, $year) {
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		return date("l", strtotime($year . '-' . $month . '-' . $day));
	}

	public function actionPendingRequests() {
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}

		if (Yii::app() -> user -> type == "Admin") {
			$message = "";
				
			if ($_POST) {
				$received_data = $_POST;
				//var_dump($received_data);
				$request = LessonRequest::model() -> find("id = " . $received_data['LessonRequest']['request_id']);
				$request -> teacher_id = $received_data['LessonRequest']['teacher_id'];
				$request -> currency_id = $received_data['LessonRequest']['currency'];
				$request -> cost = $received_data['LessonRequest']['cost'];
				$days = array("Saturday" => 0, "Sunday" => 1, "Monday" => 2, "Tuesday" => 3, "Wednesday" => 4, "Thursday" => 5, "Friday" => 6);
				$teacher = Teacher::model()->find('id = '.$received_data['LessonRequest']['teacher_id']);
				$student = Student::model()->find('id = '.$received_data['LessonRequest']['student_id']);
				if($teacher->gender != $student->gender){
					$message = "Teacher and student should be both males or both females";
				}
				for ($i = 0; $i < count($received_data['LessonRequest']['from']); $i++) {
					$from_time  = date("H:i", strtotime($received_data['LessonRequest']['from'][$i]));
					$to_time  = date("H:i", strtotime($received_data['LessonRequest']['to'][$i]));
					$dt_start = new DateTime('2001-01-01 '.$from_time);
					$dt_end = new DateTime('2001-01-1 '.$to_time);
					$dt_start_timestamp = $dt_start->getTimestamp();
					$dt_end_timestamp = $dt_end->getTimestamp();
					if($dt_end_timestamp < $dt_start_timestamp){
						$message .= "Error in slot number ".($i+1).", slot interval should be only 30 minutes or 1 hour";
					}
					else if(($dt_end_timestamp-$dt_start_timestamp)!=1800 && ($dt_end_timestamp-$dt_start_timestamp)!=3600){
						$message .= "Error in slot number ".($i+1).", slot interval should be only 30 minutes or 1 hour";
					}
					$teacher_slots = TeacherTimeSlot::model()->findAll('teacher_id = '.$received_data['LessonRequest']['teacher_id'].' and day = '.$days[$received_data['LessonRequest']['day'][$i]]);
					$check = 0;
					foreach ($teacher_slots as $teacher_slot) {
						$dt_teacher_from = new DateTime('2001-01-01 '.$teacher_slot->from);
						$dt_teacher_to = new DateTime('2001-01-01 '.$teacher_slot->to);
						$dt_teacher_from_timestamp = $dt_teacher_from->getTimestamp();
						$dt_teacher_to_timestamp = $dt_teacher_to->getTimestamp();
						if($dt_teacher_from_timestamp < $dt_start_timestamp && $dt_teacher_to_timestamp > $dt_end_timestamp){
							$check = 1;
							break;
						}
					}
					if($check == 0){
						$message .= "Teacher is not available";
					}
					//echo $message;
					
				}
				
				//if(strlen($string))
				
				for ($i = 0; $i < count($received_data['LessonRequest']['from']); $i++) {
					$received_data['LessonRequest']['from'][$i] = date("H:i", strtotime($received_data['LessonRequest']['from'][$i]));
					$received_data['LessonRequest']['to'][$i] = date("H:i", strtotime($received_data['LessonRequest']['to'][$i]));

					$date = getdate();
					$current_day_index = ($date['wday'] + 1) % 7;
					$received_day_index = $days[$received_data['LessonRequest']['day'][$i]];

					$initial_counter = $received_day_index - $current_day_index;
					//var_dump($initial_counter);

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

						$lesson -> save();
						//var_dump($lesson -> getErrors());

						//echo $expected_start_time." ".$expected_start_time."<br>";
					}
					$end = new DateTime();
					$end -> setTimestamp($current_time);
					$end_date = $end -> format('Y-m-d');

					$request -> end_date = $end_date;

					//echo "<br>";

				}
				$request -> status = 1;
				$request -> save();
				$request -> getErrors();

			}
			$result = LessonRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll("status = 0");
			$teachers = Teacher::model() -> findAll();
			if(strlen($message) < 1)
				$message = "Accepted Successfully";
			$this -> render('PendingRequests', array("results" => $result, "teachers" => $teachers , "my_message"=>$message));
		}
		else{
			$this -> redirect('index.php?r=Calendar/CalendarView');
		}

	}

}
