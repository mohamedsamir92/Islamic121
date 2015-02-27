<?php

class DashBoardController extends Controller
{
	public function actionIndex()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		$this->render('index');
	}
	
	public function actionAdminDashBoard()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		if(Yii::app()->user->type != "Admin"){
			$this->redirect("index.php?r=Calendar/CalendarView");
		}
		$this->render('admin_dashboard');
	}
	public function actionTeacherDashBoard()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		if(Yii::app()->user->type != "Teacher"){
			$this->redirect("index.php?r=Calendar/CalendarView");
		}
		$this->render('teacher_dashboard');
	}
	public function actionStudentDashBoard()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		$this->render('student_dashboard');
	}
}