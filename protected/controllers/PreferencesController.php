<?php

class PreferencesController extends Controller {

	public function actionIndex() {
		if (!isset(Yii::app() -> user -> id)) {
			$this -> redirect("index.php?r=DataModule/Login");
		}
		$this -> render('index');
	}

	public function actionPreviewValidationRules() {
		$is_insert = false;
        $insert_success = false;
        $message = "";

        if (isset($_POST['ValidationRules']))
        {
            $is_insert = true;
            $model = new ValidationRules();
            $model->attributes = $_POST['ValidationRules'];
            if ($model->save()) {
                $insert_success = true;
                $message = "Saved Successfully!";
            } else {
                // $message = json_encode($model->getErrors());
                $message = "Error happed while insert the new data, Please try again!";
            }
        }
        else if (isset($_POST["deleteId"]))
        {
            $obj = ValidationRules::model()->find('id=:id', array(':id' => $_POST["deleteId"]) );
            $obj->delete();
        }

		
		$validation_rules = ValidationRules::model() -> findAll();
		$lesson_types = LessonType::model() -> findAll();
		$this -> render('PreviewValidationRules', array('validation_rules' => $validation_rules, 'lesson_types' => $lesson_types, 'is_insert' => $is_insert, 'insert_success' => $insert_success, 'message' => $message));
	}

}
