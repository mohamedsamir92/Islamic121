<?php

class RequestsController extends Controller {
	public function actionIndex() {
		$this -> render('index');
	}

	public function actionPendingRequests() {
		if ($_POST) {

			var_dump($_POST);
		} else {
			$result = LessonsRequest::model() -> with(array("lessonRequestTimeSlots", "teacher", "student")) -> findAll();
			$teachers = Teacher::model() -> findAll();
			//var_dump($result[2]->lessonRequestTimeSlots);
			//var_dump($result[0]->lessonRequestTimeSlots[0]);
			$this -> render('PendingRequests', array("results" => $result, "teachers" => $teachers));
		}
	}

}
