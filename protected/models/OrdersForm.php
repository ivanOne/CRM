<?php
/**
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
 */
class OrdersForm extends CFormModel{
    public $state = 'new';
    public $family;
    public $name;
    public $last_name;
    public $city;
    public $street;
    public $home_num;
    public $home_porch;
    public $home_floor;
    public $home_housing;
    public $telnum;
    public $technics;
    public $problem;
    public $courier;
    public $engineer;
    public $source;
    public $status;
    public $returns;
    public $time;
    public $failure;
    public $answer;
    public $repair_site;
    public $parts;
    public $service;
    public $discount;
    public $total;
    public $profit;
    public $get_tech;
    public $three_days;
    public $six_month;
    public $twelve_month;
    public $home_apartment;
    public $pasport;
    public $family1;
    public $name1;
    public $last_name1;
    public $city1;
    public $street1;
    public $home_num1;
    public $home_porch1;
    public $home_floor1;
    public $home_housing1;
    public $telnum1;
    public $home_apartment1;
    public $pasport1;
    public $email;
    public $index;
    public $intercom;


    public function rules()
    {
        switch ($this->state){
            case 'new':
                return array(
                    //array('status,family,name,last_name,problem,source,status,home_num,home_apartment,tehnics,telnum,city,street', 'required','message'=>'Поле обязательно для заполнения'),
                    // The following rule is used by search().
                    array('email','length','max'=>255),
                    // @todo Please remove those attributes that should not be searched.
                    array('status,family,name,last_name,problem,source,status,home_num,home_apartment,technics,telnum,city,street,pasport,id, home_housing,home_floor,home_porch,id_abc,city1,street1,telnum1,family1,name1,last_name1,home_num1,home_apartment1,home_housing1,home_floor1,home_porch1,customer, technics, problem, courier, manager, engineer, source, status, return, date, time, failure, answer, repair_site, parts,service, discount, total, profit, get_tech, three_days, six_month, twelfe_month,returns,email,index,intercom', 'safe'),
                );
        }
    }

    public function attributeLabels()
    {
        return array(
            'time' => 'Желаемое время визита',
            'name' => 'Имя',
            'family' => 'Фамилия',
            'last_name' => 'Отчество',
            'city' => 'Город',
            'street' => 'Улица',
            'pasport' => 'Номер паспорта',
            'home_num' => 'Дом',
            'home_porch' => 'Подъезд',
            'home_floor' => 'Этаж',
            'home_housing' => 'Корпус',
            'home_apartment' => 'Квартира',
            'telnum' => 'Номер телефона',
            'problem' => 'Проблема',
            'technics' => 'Техника',
            'courier' => 'Курьер',
            'engineer' => 'Инженер',
            'source' => 'Источник заказа',
            'status' => 'Статус',
            'failure' => "Причина отказа",
            'returns' => 'Возврат по гарантии',
            'name1' => 'Имя',
            'family1' => 'Фамилия',
            'last_name1' => 'Отчество',
            'city1' => 'Город',
            'street1' => 'Улица',
            'home_num1' => 'Дом',
            'home_porch1' => 'Подъезд',
            'home_floor1' => 'Этаж',
            'home_housing1' => 'Корпус',
            'home_apartment1' => 'Квартира',
            'telnum1' => 'Номер телефона',
            'repair_site'=>'Место ремонта',
            'answer' => 'Проведенные работы',
            'parts'=>'Запчасти',
            'discount'=>'Скидка в %',
            'total'=>'Итоговый чек',
            'profit'=>'Чистая прибыль',
            'get_tech'=>'Оплачено',
            'pasport1'=>'Номер паспорта',
            'email'=>'E-mail',
            'index'=>'Почтовый индекс',
            'three_days'=>'Три дня',
            'six_month'=>'Шесть месяцев',
            'twelve_month'=>'Двенадцать месяцев',
            'intercom'=>'Код в подъезде'

        );
    }

    public function getParts(){
        $arrParts = array();

        if(is_array($_POST['partsName'])){
            $arrParts = array_combine($_POST['partsName'],$_POST['partsPrice']);
        }
        else{
            $arrParts[$_POST['partsName']] = $_POST['partsPrice'];
        }
        $atributes = json_encode($arrParts);
        return $atributes;
    }

    public function getService(){
        $arrService = array();
        foreach($_POST['service'] as $serv){
            $arrService[] = $serv;
        }

        $arrService['itog'] = $_POST['itog'];
        $atributes = json_encode($arrService);
        return $atributes;
    }

}