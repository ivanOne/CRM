<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string $id_abc
 * @property integer $customer
 * @property integer $technics
 * @property string $problem
 * @property integer $courier
 * @property integer $manager
 * @property integer $engineer
 * @property integer $source
 * @property integer $status
 * @property integer $return
 * @property string $date
 * @property string $time
 * @property string $failure
 * @property string $answer
 * @property integer $repair_site
 * @property string $parts
 * @property string $service_parts
 * @property integer $discount
 * @property integer $total
 * @property integer $profit
 * @property integer $get_tech
 * @property integer $three_days
 * @property integer $six_month
 * @property integer $twelfe_month
 * @property integer $time_close
 */
class Orders extends CActiveRecord
{
	public function tableName()
	{
		return 'orders';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer, manager, status, date', 'required'),
			array('customer, courier, manager, engineer, source, status, returns, repair_site, discount, total, profit, get_tech, three_days, six_month, twelfe_month', 'numerical', 'integerOnly'=>true),
			array('id_abc', 'length', 'max'=>11),
			array('parts,technics', 'length', 'max'=>255),
			array('problem, time, failure, answer, service,profit,discount,get_tech', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_abc, customer, technics, problem, courier, manager, engineer, source, status, return, date, time, failure, answer, repair_site, parts, service, discount, total, profit, get_tech, three_days, six_month, twelfe_month,time_close', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'stat'=>array(self::BELONGS_TO, 'Status', 'status'),
            'fio'=>array(self::BELONGS_TO, 'Customers', 'customer'),
            'couriers'=>array(self::BELONGS_TO, 'UserProfiles', 'courier'),
            'ing'=>array(self::BELONGS_TO, 'UserProfiles', 'engineer'),
            'man'=>array(self::BELONGS_TO, 'UserProfiles', 'manager'),
            'sou'=>array(self::BELONGS_TO, 'Source', 'source'),
            'ads'=>array(self::HAS_ONE, 'AdsPay', 'id'),
		);
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_abc' => 'Номер',
			'customer' => 'Клиент',
			'technics' => 'Technics',
			'problem' => 'Problem',
			'courier' => 'Courier',
			'manager' => 'Manager',
			'engineer' => 'Engineer',
			'source' => 'Source',
			'status' => 'Статус',
			'returns' => 'Return',
			'date' => 'Дата заказа',
			'time' => 'Time',
			'failure' => 'Failure',
			'answer' => 'Answer',
			'repair_site' => 'Repair Site',
			'parts' => 'Parts',
			'service' => 'Service Parts',
			'discount' => 'Discount',
			'total' => 'Total',
			'profit' => 'Profit',
			'get_tech' => 'Get Tech',
			'three_days' => 'Three Days',
			'six_month' => 'Six Month',
			'twelfe_month' => 'Twelfe Month',
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_abc',$this->id_abc,true);
		$criteria->compare('customer',$this->customer);
		$criteria->compare('technics',$this->technics);
		$criteria->compare('problem',$this->problem,true);
		$criteria->compare('courier',$this->courier);
		$criteria->compare('manager',$this->manager);
		$criteria->compare('engineer',$this->engineer);
		$criteria->compare('source',$this->source);
		$criteria->compare('status',$this->status);
		$criteria->compare('returns',$this->return);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('failure',$this->failure,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('repair_site',$this->repair_site);
		$criteria->compare('parts',$this->parts,true);
		$criteria->compare('service',$this->service_parts,true);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('total',$this->total);
		$criteria->compare('profit',$this->profit);
		$criteria->compare('get_tech',$this->get_tech);
		$criteria->compare('three_days',$this->three_days);
		$criteria->compare('six_month',$this->six_month);
		$criteria->compare('twelfe_month',$this->twelfe_month);
        $criteria->compare('time_close',$this->time_close);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave(){
        if(parent::beforeSave()) {
            if($this->repair_site == "1"){
                $this->time = null;
            }else{
                if($this->time == ""){
                    $this->time = "0000-00-00 00:00:00";
                }else{
                    $this->time = date("Y-m-d H:i:s",strtotime($this->time));
                }
            }
            if(($this->status == 3 or $this->status == 4) and !$this->isNewRecord){
                $order = Orders::model()->findByPk($this->id);
                if(!($order->status == 3 or $order->status == 4)){
                    $this->time_close = date("Y-m-d", time());
                }
            }
            return true;
        }
        else{
            return false;
        }
    }


}
