<?php

class CalendarController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionCalendarView()
	{
		if(Yii::app()->user->type == 'admin'){
			$this->render('CalendarView');
		}else{
		$lessons = Lesson::model()->findAll("student_id = ".Yii::app() -> user -> id." or teacher_id = ".Yii::app() -> user -> id);
		$this->render('CalendarView',array("lessons"=>$lessons));
		}
	}
}