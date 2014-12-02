<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 25.09.2014
 * Time: 10:41
 */

class UsersCreateForm extends CFormModel
{
    public $login;
    public $email;
    public $password;
    public $roles;
    public $fio;
    public $type = 'ins';
    /*
     * Разные правила валидации для записи данных и из обновления
     */
    public function rules()
    {
        if($this->type==='ins'){
            return array(
                array('login, email, password, fio, roles', 'required'),
                array('fio','length','max'=>255),
                array('password','length','max'=>20),
                array('email', 'email'),
            );
        }
        elseif($this->type==='upd'){
            return array(
                array('login, email, fio, roles', 'required'),
                array('fio','length','max'=>255),
                array('password','length','max'=>20),
                array('email', 'email'),
            );
        }

    }
    public function attributeLabels()
    {
        return array(
            'login'=>'Логин',
            'password'=>'Пароль',
            'email'=>'e-mail',
            'roles'=>'Роли',
            'fio'=>'ФИО'
        );
    }
} 