<?php

/**
 * This is the model class for table "lesson_request_time_slot".
 *
 * The followings are the available columns in table 'lesson_request_time_slot':
 * @property integer $id
 * @property integer $lesson_request_id
 * @property integer $day
 * @property string $from
 * @property string $to
 *
 * The followings are the available model relations:
 * @property LessonsRequest $lessonRequest
 */
class LessonRequestTimeSlot extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lesson_request_time_slot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lesson_request_id, day, from, to, lesson_type', 'required'),
			array('lesson_request_id, day, lesson_type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, lesson_request_id, day, from, to, lesson_type', 'safe', 'on'=>'search'),
			//array('from',  'checkTimes'),
		);
	}
	
	/*public function checkTimes($attributes,$params){
		echo $this->from;
		$dt_start = new DateTime('2001-01-1 '.$this->from);
		$dt_end = new DateTime('2001-01-1 '.$this->to);
		echo $dt_start->format('YmdH') . "\n";
		$this->addError('from','Incorrect Timing.');
		
	}*/
	

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'lessonRequest' => array(self::BELONGS_TO, 'LessonRequest', 'lesson_request_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lesson_request_id' => 'Lesson Request',
			'day' => 'Day',
			'from' => 'From',
			'to' => 'To',
			'lesson_type' => 'Lesson Type',
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
		$criteria->compare('lesson_request_id',$this->lesson_request_id);
		$criteria->compare('day',$this->day);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('to',$this->to,true);
		$criteria->compare('lesson_type',$this->lesson_type);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LessonRequestTimeSlot the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
