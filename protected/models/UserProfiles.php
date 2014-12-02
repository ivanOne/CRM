<?php

/**
 * This is the model class for table "user_profiles".
 *
 * The followings are the available columns in table 'user_profiles':
 * @property integer $id_user
 * @property string $fio
 * @property integer $telephone
 * @property string $passport
 * @property string $propiska
 * @property string $dob
 * @property string $first_day
 * @property string $other
 *
 * The followings are the available model relations:
 * @property TimeTable[] $timeTables
 * @property Users $idUser
 */
class UserProfiles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_profiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, fio', 'required'),
			array('id_user', 'numerical', 'integerOnly'=>true),
			array('fio', 'length', 'max'=>255),
            array('telephone','length','max'=>30),
			array('passport, propiska, dob, first_day, other', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, fio, telephone, passport, propiska, dob, first_day, other', 'safe', 'on'=>'search'),
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
			'timeTables' => array(self::HAS_MANY, 'TimeTable', 'people'),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'fio' => 'Fio',
			'telephone' => 'Telephone',
			'passport' => 'Passport',
			'propiska' => 'Propiska',
			'dob' => 'Dob',
			'first_day' => 'First Day',
			'other' => 'Other',
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

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('telephone',$this->telephone);
		$criteria->compare('passport',$this->passport,true);
		$criteria->compare('propiska',$this->propiska,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('first_day',$this->first_day,true);
		$criteria->compare('other',$this->other,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserProfiles the static model class
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
            if($this->first_day){
                $this->first_day = date('Y-m-d',strtotime($this->first_day));
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
        echo $text;
    }
}
