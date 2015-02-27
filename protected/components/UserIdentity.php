<?php

class UserIdentity extends CUserIdentity {
	private $_id;
	private $_type;
	public function authenticate() {
		//echo $this -> _type;
		$record = null;
		if ($this -> _type == "Teacher")
			$record = Teacher::model() -> findByAttributes(array('username' => $this -> username));
		else if ($this -> _type == "Student")
			$record = Student::model() -> findByAttributes(array('username' => $this -> username));
		else if ($this -> _type == "Admin")
			$record = Admin::model() -> findByAttributes(array('username' => $this -> username));

		if ($record === null)
			$this -> errorCode = self::ERROR_USERNAME_INVALID;
		else if (!$record -> validatePassword($this -> password))
			$this -> errorCode = self::ERROR_PASSWORD_INVALID;
		else {
			//var_dump($record);
			if($this->_type == "Student"){
				$request = LessonRequest::model()->find("student_id = ".$record -> id);
				if($request->status == 0){
					$this -> errorCode = self::ERROR_USERNAME_INVALID;
					return !$this -> errorCode;
				}
				
			}
			$this -> _id = $record -> id;
			
			$this -> setState('first_name', $record -> first_name);
			$this -> setState('last_name', $record -> last_name);
			$this -> setState('phone_no', $record -> phone_no);
			$this -> setState('email', $record -> email);
			$this -> setState('skype_id', $record -> skype_id);
			$this -> setState('username', $record -> username);
			$this -> setState('age', $record -> age);
			$this -> setState('country', $record -> country);
			$this -> setState('city', $record -> city);
			$this -> setState('gender', $record -> gender);
			$this -> setState('image', $record -> image);
			$this -> setState('notes', $record -> notes);
			$this -> setState('type', $this -> _type);

			//$this -> setState('title', $record -> title);
			$this -> errorCode = self::ERROR_NONE;
		}
		return !$this -> errorCode;
	}

	public function update(){
		$record = null;
		if ($this -> _type == "Teacher")
			$record = Teacher::model() -> findByAttributes(array('username' => $this -> username));
		else if ($this -> _type == "Student")
			$record = Student::model() -> findByAttributes(array('username' => $this -> username));
		else if ($this -> _type == "Admin")
			$record = Admin::model() -> findByAttributes(array('username' => $this -> username));

		if ($record === null)
			$this -> errorCode = self::ERROR_USERNAME_INVALID;
		else {
			var_dump($record);
			
			$this -> _id = $record -> id;
			$this -> setState('first_name', $record -> first_name);
			$this -> setState('last_name', $record -> last_name);
			$this -> setState('phone_no', $record -> phone_no);
			$this -> setState('email', $record -> email);
			$this -> setState('skype_id', $record -> skype_id);
			$this -> setState('username', $record -> username);
			$this -> setState('age', $record -> age);
			$this -> setState('country', $record -> country);
			$this -> setState('city', $record -> city);
			$this -> setState('gender', $record -> gender);
			$this -> setState('image', $record -> image);
			$this -> setState('notes', $record -> notes);
			$this -> setState('type', $this -> _type);

			//$this -> setState('title', $record -> title);
			$this -> errorCode = self::ERROR_NONE;
		}
		return !$this -> errorCode;
				
		
	}

	public function getId() {
		return $this -> _id;
	}

	public function setType($type) {
		$this -> _type = $type;
	}

}
