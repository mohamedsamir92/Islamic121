<?php

class MembersController extends Controller
{
	public function actionIndex()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		$this->render('index');
	}
	
	public function actionTeachers()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		
		if(Yii::app()->user->type != "Admin"){
			$this->redirect("index.php?r=Calendar/CalendarView");
		}
		
		$result = Teacher::model()->with("teacherTimeSlots")->findAll();
		//var_dump($result[0]->teacherTimeSlots);
		$this->render('Teachers',array("results"=>$result));
	}
	
	public function actionStudents()
	{
		
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		
		if(Yii::app()->user->type == "Student"){
			$this->redirect("index.php?r=Calendar/CalendarView");
		}
		$result = LessonRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll("status = 1");
		$teachers = Teacher::model() -> findAll();
		//var_dump($result[2]->lessonRequestTimeSlots);
		//var_dump($result[0]->lessonRequestTimeSlots[0]);
		$this -> render('Students', array("results" => $result, "teachers" => $teachers));
	}
}