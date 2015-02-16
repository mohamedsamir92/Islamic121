<?php

class MembersController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionTeachers()
	{
		$this->render('Teachers');
	}
	
	public function actionStudents()
	{
		$this->render('Students');
	}
}