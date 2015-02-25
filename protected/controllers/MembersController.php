<?php

class MembersController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionTeachers()
	{
		$result = Teacher::model()->with("teacherTimeSlots")->findAll();
		//var_dump($result[0]->teacherTimeSlots);
		$this->render('Teachers',array("results"=>$result));
	}
	
	public function actionStudents()
	{
		$result = LessonRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll("status = 1");
		$teachers = Teacher::model() -> findAll();
		//var_dump($result[2]->lessonRequestTimeSlots);
		//var_dump($result[0]->lessonRequestTimeSlots[0]);
		$this -> render('Students', array("results" => $result, "teachers" => $teachers));
	}
}