<?php

class PreviewController extends Controller
{
	public function actionIndex()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		$this->render('index');
	}
	
	public function actionPreviewTeacher()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		$slots = TeacherTimeSlot::model()->findAll("teacher_id = ".Yii::app()->user->id);
		$this->render('PreviewTeacher' , array("slots"=>$slots));
	}
	
	public function actionPreviewAdmin()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		$this->render('PreviewAdmin');
	}
	public function actionPreviewStudent()
	{
		if(!isset(Yii::app()->user->id)){
			$this->redirect("index.php?r=DataModule/Login");
		}
		//var_dump(Yii::app()->user->id);
		
		$request = LessonRequest::model()->find("student_id = ".Yii::app()->user->id);
		//var_dump($request);
		$slots = LessonRequestTimeSlot::model()->findAll("lesson_request_id = ".$request->id);
		
		$record = Student::model()->find("id = ".Yii::app()->user->id);
		$this->render('PreviewStudent',array("Guardian"=>$record->guardians_name , "slots"=>$slots));
	}
}