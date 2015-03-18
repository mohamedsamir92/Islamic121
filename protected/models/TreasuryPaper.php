<?php

/**
 * This is the model class for table "treasury_paper".
 *
 * The followings are the available columns in table 'treasury_paper':
 * @property integer $id
 * @property integer $currency_id
 * @property integer $user_id
 * @property integer $user_type
 * @property integer $paper_type
 * @property integer $type
 * @property double $value
 * @property string $notes
 * @property string $date
 * @property string $actual_date
 */
class TreasuryPaper extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'treasury_paper';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('currency_id, paper_type, type, value, notes, date', 'required'),
			array('currency_id, user_id, user_type, paper_type, type', 'numerical', 'integerOnly'=>true),
			array('value', 'numerical'),
			array('actual_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, currency_id, user_id, user_type, paper_type, type, value, notes, date, actual_date', 'safe', 'on'=>'search'),
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
			'currency_id' => 'Currency',
			'user_id' => 'User',
			'user_type' => 'User Type',
			'paper_type' => 'Paper Type',
			'type' => 'Type',
			'value' => 'Value',
			'notes' => 'Notes',
			'date' => 'Date',
			'actual_date' => 'Actual Date',
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
		$criteria->compare('currency_id',$this->currency_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('paper_type',$this->paper_type);
		$criteria->compare('type',$this->type);
		$criteria->compare('value',$this->value);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('actual_date',$this->actual_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TreasuryPaper the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
