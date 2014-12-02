<?php

/**
 * This is the model class for table "time_table".
 *
 * The followings are the available columns in table 'time_table':
 * @property integer $id
 * @property string $dates
 * @property integer $people
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property UserProfiles $people0
 */
class TimeTable extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'time_table';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dates, people, status', 'required'),
			array('people, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dates, people, status', 'safe', 'on'=>'search'),
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
			'people0' => array(self::BELONGS_TO, 'UserProfiles', 'people'),
            'roles0' => array(self::BELONGS_TO,'RolesUsers','people'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dates' => 'Dates',
			'people' => 'People',
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
		$criteria->compare('dates',$this->dates,true);
		$criteria->compare('people',$this->people);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TimeTable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function generatePeopleAll($date){
        $days = date('t',strtotime("1-".$date));
        $dateW = date('Y-m-',strtotime("1-".$date));
        $list = RolesUsers::model()->with('fio')->findAll('id_role>1');
        foreach($list as $item){
           for($i=1;$i<=$days;$i++){
               $mod = new TimeTable();
               $mod->dates = $dateW.$i;
               $mod->people = $item->fio->id_user;
               $mod->status = 0;
               $mod->save();
           }
        }
    }
    public function generatePeople($id,$date){
        $days = date('t',strtotime("1-".$date));
        $dateW = date('Y-m-',strtotime("1-".$date));
        for($i=1;$i<=$days;$i++){
            $mod = new TimeTable();
            $mod->dates = $dateW.$i;
            $mod->people = $id;
            $mod->status = 0;
            $mod->save();
        }
    }
}
