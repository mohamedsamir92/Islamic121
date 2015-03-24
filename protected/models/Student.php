<?php

/**
 * This is the model class for table "student".
 *
 * The followings are the available columns in table 'student':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_no
 * @property string $email
 * @property string $skype_id
 * @property string $username
 * @property string $password
 * @property date $date_of_birth
 * @property string $country
 * @property string $city
 * @property integer $gender
 * @property integer $class_package
 * @property string $hear_us
 * @property string $image
 * @property integer $quran_course
 * @property integer $arabic_course
 * @property string $guardians_name
 * @property string $notes
 *
 * The followings are the available model relations:
 * @property LessonsRequest[] $lessonsRequests
 */
class Student extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'student';
	}
	
	public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password,$this->password);
    }
 
    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, phone_no, username, password, date_of_birth, country, city, gender, class_package, hear_us, image', 'required'),
			array('gender, class_package, quran_course, arabic_course', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, phone_no, email, skype_id, username, country, city, hear_us, image', 'length', 'max'=>100),
			array('password', 'length', 'max'=>500),
			array('date_of_birth', 'length', 'max'=>50),
			array('guardians_name', 'length', 'max'=>300),
			array('notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('username', 'unique'),
			array('email', 'unique'),
			
			array('id, first_name, last_name, phone_no, email, skype_id, username, password, date_of_birth, country, city, gender, class_package, hear_us, image, quran_course, arabic_course, guardians_name, notes', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'lessons' => array(self::HAS_MANY, 'Lesson', 'student_id'),
			'lessonRequests' => array(self::HAS_MANY, 'LessonRequest', 'student_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'phone_no' => 'Phone No',
			'email' => 'Email',
			'skype_id' => 'Skype',
			'username' => 'Username',
			'password' => 'Password',
			'date_of_birth' => 'Date Of Birth',
			'country' => 'Country',
			'city' => 'City',
			'gender' => 'Gender',
			'class_package' => 'Class Package',
			'hear_us' => 'Hear Us',
			'image' => 'Image',
			'quran_course' => 'Quran Course',
			'arabic_course' => 'Arabic Course',
			'guardians_name' => 'Guardians Name',
			'notes' => 'Notes',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('skype_id',$this->skype_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('class_package',$this->class_package);
		$criteria->compare('hear_us',$this->hear_us,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('quran_course',$this->quran_course);
		$criteria->compare('arabic_course',$this->arabic_course);
		$criteria->compare('guardians_name',$this->guardians_name,true);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Student the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
