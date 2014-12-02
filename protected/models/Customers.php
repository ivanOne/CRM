<?php

/**
 * This is the model class for table "customers".
 *
 * The followings are the available columns in table 'customers':
 * @property integer $id
 * @property string $fio
 * @property string $pasport
 * @property string $city
 * @property string $street
 * @property string $home
 * @property integer $telnum
 * @property string $intercom
 */
class Customers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fio, home,email', 'length', 'max'=>255),
			array('city, street', 'length', 'max'=>100),
            array('telnum, intercom','length','max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fio, pasport, city, street, home, telnum,email,intercom', 'safe', 'on'=>'search'),
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
			'fio' => 'Fio',
			'pasport' => 'Pasport',
			'city' => 'City',
			'street' => 'Street',
			'home' => 'Home',
			'telnum' => 'Telnum',
            'email'=>'email',
            'intercom'=>'intercom'
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
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('pasport',$this->pasport,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('street',$this->street,true);
		$criteria->compare('home',$this->home,true);
		$criteria->compare('telnum',$this->telnum);
        $criteria->compare('email',$this->email);
        $criteria->compare('intercom',$this->intercom);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function addCustomers($name,$family,$last_name,$city,$street
        ,$home_num,$home_apartment,$home_housing,$home_floor,$home_porch,$telnum,$email,$index,$pasport,$intercom,$agent=false){
        $model = new Customers();
        $model->fio = $family." ".$name." ".$last_name;
        $model->city = $city;
        $model->pasport = $pasport;
        $model->street = $street;
        $model->email = $email;
        $model->intercom = $intercom;
        $model->home = json_encode(array('home_num'=>$home_num,'home_apartment'=>$home_apartment,'home_housing'=>$home_housing,
        'home_floor'=>$home_floor,'home_porch'=>$home_porch,'index'=>$index));
        $model->telnum = $telnum;
        if($agent){
            $model->agent = $agent;
        }
        if($model->validate()){
            $model->save();
            return $model->id;
        }
        else{
            return false;
        }

    }
    public function updateCustomers($id,$name,$family,$last_name,$city,$street
        ,$home_num,$home_apartment,$home_housing,$home_floor,$home_porch,$telnum,$email,$index,$pasport,$intercom,$agent=false){
        $model = Customers::model()->findByPk($id);
        $model->fio = $family." ".$name." ".$last_name;
        $model->city = $city;
        $model->street = $street;
        $model->pasport = $pasport;
        $model->email = $email;
        $model->intercom = $intercom;
        $model->home = json_encode(array('home_num'=>$home_num,'home_apartment'=>$home_apartment,'home_housing'=>$home_housing,
            'home_floor'=>$home_floor,'home_porch'=>$home_porch,'index'=>$index));
        $model->telnum = $telnum;

        if($agent){
            $model->agent = $agent;
        }
        if($model->validate()){
            $model->save();
            return $model->id;
        }
        else{
            return false;
        }

    }
}
