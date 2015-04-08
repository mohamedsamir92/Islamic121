<?php

class LessonsController extends Controller {
	
	public function actionGetLessons(){
		$from = $_GET['from'];
		$to = $_GET['to'];
		$data = array();
		$data = array();
		$lessons = Lesson::model() -> findAll("expected_start_time between :start and :end", 
		array(":start" => $from,":end" => $to));
		
		
		foreach($lessons as $lesson){
			$teacher = DataModuleController::getTeacher($lesson->teacher_id);
			$student = DataModuleController::getStudent($lesson->student_id);
			$lessonType = LessonsController::getType($lesson->lesson_type_id);
			$entry = array();
			$entry[] = $student->first_name . " " . $student->last_name;
			$entry[] = $teacher->first_name . " " . $teacher->last_name;
			$entry[] = $lessonType->name;
			$entry[] = $lesson->expected_start_time;
			$entry[] = $lesson->expected_end_time;
			if($lesson->actual_start_time == $lesson->actual_end_time){
				$entry[] = "Not Started";
			}
			else if($lesson->actual_start_time > $lesson->actual_end_time){
				$entry[] = "In Progress";
			}
			else if($lesson->actual_start_time < $lesson->actual_end_time){
				$entry[] = "Finished";
			}
			$entry[] = $lesson->id;
			$data[] = $entry;			
		}
		
		echo json_encode($data);
		
	}	
	
	
	public function actionLessonState(){
		
		$lesson = Lesson::model()->find("id = :id",array(":id"=>$_GET['id']));
		if($lesson->actual_start_time == $lesson->actual_end_time)
			$this->render("start_lesson",array("lesson"=>$lesson));
		else if($lesson->actual_start_time > $lesson->actual_end_time)
			$this->render("finish_lesson",array("lesson"=>$lesson));
		else if($lesson->actual_start_time < $lesson->actual_end_time)
			$this->render("update_lesson",array("lesson"=>$lesson));
	}
	
	public function actionUpdateLesson(){
			
	}
	
	public function actionChangeLessonState(){
		$lesson = Lesson::model()->find("id = :id",array(":id"=>$_POST['id']));
		$date = getdate();
		
		$time = $date['year'] . "-" . sprintf("%02d", $date['mon']) . "-" . sprintf("%02d",$date['mday']) . " " . 
		sprintf("%02d",$date['hours']).":".sprintf("%02d",$date['minutes']).":".sprintf("%02d",$date['seconds']);
		
		
		if($lesson->actual_start_time == $lesson->actual_end_time)
			$lesson->actual_start_time = $time;
		else if ($lesson->actual_start_time > $lesson->actual_end_time)
			$lesson->actual_end_time = $time;
			
		$lesson->save();
		
		$start_date = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'] . " " . "00:00:00";
		$end_date = $date['year'] . "-" . $date['mon'] . "-" . (14 + $date['mday']) . " " . "00:00:00";
		
		
		if(Yii::app()->user->type == "Admin")
			$lessons = Lesson::model() -> findAll("expected_start_time between :start and :end", 
			array(":start" => $start_date,":end" => $end_date));
		else if(Yii::app()->user->type == "Teacher")
			$lessons = Lesson::model() -> findAll("teacher_id = :id and expected_start_time between :start and :end", 
			array(":id"=>Yii::app()->user->id,":start" => $start_date,":end" => $end_date));
		else return;	
		
		if($lesson->actual_start_time > $lesson->actual_end_time)
			$this->render("all_lessons",array("lessons"=>$lessons,"start_date"=>$start_date,"end_date"=>$end_date));
		else if($lesson->actual_start_time < $lesson->actual_end_time){
			$this->render("update_lesson",array("lesson"=>$lesson));
		}
	}
	
	public function actionIndex() {
		$date = getdate();
		$start_date = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'] . " " . "00:00:00";
		$end_date = $date['year'] . "-" . $date['mon'] . "-" . (14 + $date['mday']) . " " . "00:00:00";
		if(Yii::app()->user->type == "Admin")
			$lessons = Lesson::model() -> findAll("expected_start_time between :start and :end", 
			array(":start" => $start_date,":end" => $end_date));
		else if(Yii::app()->user->type == "Teacher")
			$lessons = Lesson::model() -> findAll("teacher_id = :id and expected_start_time between :start and :end", 
			array(":id"=>Yii::app()->user->id,":start" => $start_date,":end" => $end_date));
		else return;
		
		$this->render("all_lessons",array("lessons"=>$lessons,"start_date"=>$start_date,"end_date"=>$end_date));
	}
	
	public static function getType($id){
		$lessonType = LessonType::model()->find("id = :id",array(":id"=>$id));
		return $lessonType;
	}

}
