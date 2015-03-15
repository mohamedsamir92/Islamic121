<?php

class TreasuryController extends Controller {

	public function actionReport() {
		$this->render("report");
	}
	public function actionPaper() {
		$this->render("paper");
	}

}
