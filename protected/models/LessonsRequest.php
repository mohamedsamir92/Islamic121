<?php

/**
 * This is the model class for table "lessons_request".
 *
 * The followings are the available columns in table 'lessons_request':
 * @property integer $id
 * @property integer $student_id
 * @property integer $teacher_id
 * @property string $start_date
 * @property string $end_date
 * @property double $cost
 * @property integer $currency_id
 * @property string $notes
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property LessonRequestTimeSlot[] $lessonRequestTimeSlots
 * @property Student $student
 * @property Teacher $teacher
 */
class LessonsRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lesson_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, teacher_id', 'required'),
			array('student_id, teacher_id, currency_id, status', 'numerical', 'integerOnly'=>true),
			array('cost', 'numerical'),
			array('start_date, end_date, notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, student_id, teacher_id, start_date, end_date, cost, currency_id, notes, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		/*return array(
			'lessonRequestTimeSlots' => array(self::HAS_MANY, 'LessonRequestTimeSlot', 'lesson_request_id'),
			'student' => array(self::BELONGS_TO, 'Student', 'student_id'),
			'teacher' => array(self::BELONGS_TO, 'Teacher', 'teacher_id'),
		);*/
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'student_id' => 'Student',
			'teacher_id' => 'Teacher',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'cost' => 'Cost',
			'currency_id' => 'Currency',
			'notes' => 'Notes',
			'status' => 'Status',
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
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('teacher_id',$this->teacher_id);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LessonsRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
