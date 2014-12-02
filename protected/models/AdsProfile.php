<?php

/**
 * This is the model class for table "ads_profile".
 *
 * The followings are the available columns in table 'ads_profile':
 * @property integer $id
 * @property string $passport
 * @property string $propiska
 * @property string $telnum
 * @property string $dob
 * @property string $first_day
 * @property string $fio
 */
class AdsProfile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ads_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fio', 'required'),
			array('telnum', 'length', 'max'=>12),
			array('fio', 'length', 'max'=>100),
			array('passport, propiska, dob, first_day', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, passport, propiska, telnum, dob, first_day, fio', 'safe', 'on'=>'search'),
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
			'passport' => 'Passport',
			'propiska' => 'Propiska',
			'telnum' => 'Telnum',
			'dob' => 'Dob',
			'first_day' => 'First Day',
			'fio' => 'Fio',
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
		$criteria->compare('passport',$this->passport,true);
		$criteria->compare('propiska',$this->propiska,true);
		$criteria->compare('telnum',$this->telnum,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('first_day',$this->first_day,true);
		$criteria->compare('fio',$this->fio,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdsProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave()
    {
        if(parent::beforeSave()){
            if($this->dob){
                $this->dob = date('Y-m-d',strtotime($this->dob));
            }
            else{
                $this->dob = null;
            }
            if($this->first_day){
                $this->first_day = date('Y-m-d',strtotime($this->first_day));
            }
            else{
                $this->first_day = null;
            }
            return true;
        }
        else{
            return false;
        }

    }
    public function afterFind(){
        parent::afterFind();
        if($this->first_day){
            $this->first_day = date('d.m.Y',strtotime($this->first_day));
        }
        if($this->dob){
            $this->dob = date('d.m.Y',strtotime($this->dob));
        }

    }

    public static function getPas($pas){
        $pass = json_decode($pas);
        $text = "Когда выдан - ".$pass->vydan.", Дата выдачи - ".$pass->data_v.", Код подразделения - ".$pass->kod.", Номер паспорта - ".$pass->num_pas.",
        Место рождения - ".$pass->mesto_r.", Прописка - ".$pass->registration."";
        return $text;
    }
}
