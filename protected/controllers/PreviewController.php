<?php

class PreviewController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionPreviewTeacher()
	{
		$this->render('PreviewTeacher');
	}
	
	public function actionPreviewAdmin()
	{
		$this->render('PreviewAdmin');
	}
	public function actionPreviewStudent()
	{
		
		$record = Student::model()->find("id = ".Yii::app()->user->id);
		$this->render('PreviewStudent',array("Guardian"=>$record->guardians_name));
	}
}