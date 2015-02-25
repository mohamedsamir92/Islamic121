<?php

/**
 * This is the model class for table "teacher_time_slot".
 *
 * The followings are the available columns in table 'teacher_time_slot':
 * @property integer $id
 * @property integer $teacher_id
 * @property integer $day
 * @property string $from
 * @property string $to
 *
 * The followings are the available model relations:
 * @property Teacher $teacher
 */
class TeacherTimeSlot extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'teacher_time_slot';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacher_id, day, from, to', 'required'),
			array('teacher_id, day', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, teacher_id, day, from, to', 'safe', 'on'=>'search'),
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
			'teacher' => array(self::BELONGS_TO, 'Teacher', 'teacher_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'teacher_id' => 'Teacher',
			'day' => 'Day',
			'from' => 'From',
			'to' => 'To',
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
		$criteria->compare('teacher_id',$this->teacher_id);
		$criteria->compare('day',$this->day);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('to',$this->to,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TeacherTimeSlot the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
