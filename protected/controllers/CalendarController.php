<?php

class CalendarController extends Controller
{
	public function actionIndex()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		$this->render('index');
	}
	
	public function actionCalendarView()
	{
		//echo Yii::app()->user->type;
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		if(Yii::app()->user->type == 'Admin'){
			$lessons = Lesson::model()->with(array("student", "teacher"))->findAll();
			$this->render('CalendarView',array("lessons"=>$lessons));
		}else{
		$lessons = Lesson::model()->findAll("student_id = ".Yii::app() -> user -> id." or teacher_id = ".Yii::app() -> user -> id);
		$this->render('CalendarView',array("lessons"=>$lessons));
		}
	}
}