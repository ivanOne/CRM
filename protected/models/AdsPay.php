<?php

/**
 * This is the model class for table "ads_pay".
 *
 * The followings are the available columns in table 'ads_pay':
 * @property integer $id
 * @property string $id_abc
 * @property integer $region
 * @property string $addr
 * @property string $date
 * @property integer $ads
 * @property integer $pay
 */
class AdsPay extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ads_pay';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, region, pay', 'numerical', 'integerOnly'=>true),
			array('id_abc', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_abc, region, addr, date, ads, pay', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'region0'=>array(self::BELONGS_TO, 'AdsRegion', 'region'),
            'orders0'=>array(self::BELONGS_TO, 'Orders', 'id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_abc' => 'Id Abc',
			'region' => 'Region',
			'addr' => 'Addr',
			'date' => 'Date',
			'ads' => 'Ads',
			'pay' => 'Pay',
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
		$criteria->compare('id_abc',$this->id_abc,true);
		$criteria->compare('region',$this->region);
		$criteria->compare('addr',$this->addr,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('ads',$this->ads);
		$criteria->compare('pay',$this->pay);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdsPay the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
