<?php

class DashBoardController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionAdminDashBoard()
	{
		$this->render('admin_dashboard');
	}
	public function actionTeacherDashBoard()
	{
		$this->render('teacher_dashboard');
	}
	public function actionStudentDashBoard()
	{
		$this->render('student_dashboard');
	}
}