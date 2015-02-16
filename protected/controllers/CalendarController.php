<?php

class CalendarController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionCalendarView()
	{
		$this->render('CalendarView');
	}
}