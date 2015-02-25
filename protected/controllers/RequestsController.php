<?php

class RequestsController extends Controller {
	public function actionIndex() {
		$this -> render('index');
	}

	function getWeekDay($day, $month, $year) {
		return date("l", strtotime($year . '-' . $month . '-' . $day));
	}

	public function actionPendingRequests() {
		if ($_POST) {

			$received_data = $_POST;
			//var_dump($received_data);
			$request = LessonRequest::model()->find("id = ".$received_data['LessonRequest']['request_id']);
			$request->teacher_id = $received_data['LessonRequest']['teacher_id'];
			$request->currency_id = $received_data['LessonRequest']['currency'];
			$request->cost = $received_data['LessonRequest']['cost'];
			$days = array("Saturday" => 0, "Sunday" => 1, "Monday" => 2, "Tuesday" => 3, "Wednesday" => 4, "Thursday" => 5, "Friday" => 6);

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
				$request->start_date = $current_date;
				while ($current_time < $next_year_time) {
					$lesson = new Lesson;

					$id = $received_data['LessonRequest']['student_id'];

					$expected_date = new DateTime();
					$expected_date -> setTimestamp($current_time);

					$expected_start_time = $expected_date -> format('Y-m-d') . " " . $received_data['LessonRequest']['from'][$i];
					$expected_end_time = $expected_date -> format('Y-m-d') . " " . $received_data['LessonRequest']['to'][$i];

					$current_time = strtotime($current_date . "+ " . $counter . " days");
					$counter += 7;

					$lesson->student_id = $id;
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
				
				$request->end_date = $end_date;
				

				//echo "<br>";

			}
			$request->status = 1;
			$request->save();
			$request->getErrors();

			/*$d = new DateTime();
			 $d->setTimestamp($current_time);

			 $current_date = $d->format('Y-m-d');
			 $current_time = strtotime($current_date."+ 1 days");

			 var_dump($current_time);
			 var_dump($next_year_time);
			 var_dump(($current_time > $next_year_time));
			 // as sunday index is 0 in date object
			 $days = array("Saturday" => 0, "Sunday" => 1, "Monday" => 2, "Tuesday" => 3, "Wednesday" => 4, "Thursday" => 5, "Friday" => 6);

			 $nextDay = strtotime(date("Y-m-d")."+ 1 day");

			 //var_dump($nextDay);
			 */
		}
		$result = LessonRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll("status = 0");
		$teachers = Teacher::model() -> findAll();
		//var_dump($result[2]->lessonRequestTimeSlots);
		//var_dump($result[0]->lessonRequestTimeSlots[0]);
		$this -> render('PendingRequests', array("results" => $result, "teachers" => $teachers));
		

	}

}
