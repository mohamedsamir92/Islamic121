<?php

/**
 * This is the model class for table "lesson".
 *
 * The followings are the available columns in table 'lesson':
 * @property integer $id
 * @property integer $student_id
 * @property integer $teacher_id
 * @property string $expected_start_time
 * @property string $expected_end_time
 * @property string $actual_start_time
 * @property string $actual_end_time
 * @property double $cost
 * @property integer $currency_id
 * @property integer $actual_start_ayah
 * @property integer $actual_end_ayah
 * @property integer $actual_start_surah
 * @property integer $actual_end_surah
 * @property integer $front_revision_start_ayah
 * @property integer $front_revision_end_ayah
 * @property integer $front_revision_start_surah
 * @property integer $front_revision_end_surah
 * @property integer $back_revision_start_ayah
 * @property integer $back_revision_end_ayah
 * @property integer $back_revision_start_surah
 * @property integer $back_revision_end_surah
 * @property double $grade
 * @property string $notes
 */
class Lesson extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lesson';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id, teacher_id, expected_start_time, cost, currency_id', 'required'),
			array('student_id, teacher_id, currency_id, actual_start_ayah, actual_end_ayah, actual_start_surah, actual_end_surah, front_revision_start_ayah, front_revision_end_ayah, front_revision_start_surah, front_revision_end_surah, back_revision_start_ayah, back_revision_end_ayah, back_revision_start_surah, back_revision_end_surah', 'numerical', 'integerOnly'=>true),
			array('cost, grade', 'numerical'),
			array('expected_end_time, actual_start_time, actual_end_time, notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, student_id, teacher_id, expected_start_time, expected_end_time, actual_start_time, actual_end_time, cost, currency_id, actual_start_ayah, actual_end_ayah, actual_start_surah, actual_end_surah, front_revision_start_ayah, front_revision_end_ayah, front_revision_start_surah, front_revision_end_surah, back_revision_start_ayah, back_revision_end_ayah, back_revision_start_surah, back_revision_end_surah, grade, notes', 'safe', 'on'=>'search'),
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
		);
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
			'expected_start_time' => 'Expected Start Time',
			'expected_end_time' => 'Expected End Time',
			'actual_start_time' => 'Actual Start Time',
			'actual_end_time' => 'Actual End Time',
			'cost' => 'Cost',
			'currency_id' => 'Currency',
			'actual_start_ayah' => 'Actual Start Ayah',
			'actual_end_ayah' => 'Actual End Ayah',
			'actual_start_surah' => 'Actual Start Surah',
			'actual_end_surah' => 'Actual End Surah',
			'front_revision_start_ayah' => 'Front Revision Start Ayah',
			'front_revision_end_ayah' => 'Front Revision End Ayah',
			'front_revision_start_surah' => 'Front Revision Start Surah',
			'front_revision_end_surah' => 'Front Revision End Surah',
			'back_revision_start_ayah' => 'Back Revision Start Ayah',
			'back_revision_end_ayah' => 'Back Revision End Ayah',
			'back_revision_start_surah' => 'Back Revision Start Surah',
			'back_revision_end_surah' => 'Back Revision End Surah',
			'grade' => 'Grade',
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
		$criteria->compare('student_id',$this->student_id);
		$criteria->compare('teacher_id',$this->teacher_id);
		$criteria->compare('expected_start_time',$this->expected_start_time,true);
		$criteria->compare('expected_end_time',$this->expected_end_time,true);
		$criteria->compare('actual_start_time',$this->actual_start_time,true);
		$criteria->compare('actual_end_time',$this->actual_end_time,true);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('actual_start_ayah',$this->actual_start_ayah);
		$criteria->compare('actual_end_ayah',$this->actual_end_ayah);
		$criteria->compare('actual_start_surah',$this->actual_start_surah);
		$criteria->compare('actual_end_surah',$this->actual_end_surah);
		$criteria->compare('front_revision_start_ayah',$this->front_revision_start_ayah);
		$criteria->compare('front_revision_end_ayah',$this->front_revision_end_ayah);
		$criteria->compare('front_revision_start_surah',$this->front_revision_start_surah);
		$criteria->compare('front_revision_end_surah',$this->front_revision_end_surah);
		$criteria->compare('back_revision_start_ayah',$this->back_revision_start_ayah);
		$criteria->compare('back_revision_end_ayah',$this->back_revision_end_ayah);
		$criteria->compare('back_revision_start_surah',$this->back_revision_start_surah);
		$criteria->compare('back_revision_end_surah',$this->back_revision_end_surah);
		$criteria->compare('grade',$this->grade);
		$criteria->compare('notes',$this->notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lesson the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
