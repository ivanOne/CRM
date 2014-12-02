<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 23.10.2014
 * Time: 10:48
 */

class AdsCardForm extends CFormModel{

    public $fio;
    public $id;
    public $telephone;
    public $vydan;
    public $data_v;
    public $kod;
    public $num_pas;
    public $mesto_r;
    public $registration;
    public $mesto_j;
    public $dob;
    public $date_start;


    public function attributeLabels()
    {
        return array(
            'id'=>'Номер',
            'fio'=>'Фамилия Имя Отчество',
            'telephone'=>'Телефон',
            'vydan'=>'Кем выдан',
            'data_v'=>'Дата выдачи',
            'kod'=>'Код подразделения',
            'num_pas'=>'Номер паспорта',
            'mesto_r'=>'Место рождения',
            'registration'=>'Место прописки',
            'mesto_j'=>'Место жительства',
            'dob'=>'Дата рождения',
            'date_start'=>'Дата начала работы',
        );
    }

    public function rules()
    {
        return array(
            array('fio','required'),
            array('fio', 'length','max'=>255),
            array('telephone', 'length','max'=>11),
        );
    }
} 