<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $email
 *
 * The followings are the available model relations:
 * @property RolesUsers $rolesUsers
 * @property UserProfiles[] $userProfiles
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('login, password, email', 'required'),
            array('login','unique'),
			array('login', 'length', 'max'=>20),
			array('password, email', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, password, email', 'safe', 'on'=>'search'),
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
			'rolesUsers' => array(self::HAS_ONE, 'RolesUsers', 'id_user'),
			'userProfiles' => array(self::HAS_MANY, 'UserProfiles', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'password' => 'Password',
			'email' => 'Email',
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    /*
     * Проверяем есть ли пароль при сохранении данных, если да то жешируем
     */
    protected function beforeSave()
    {
        if(!empty($this->password)){
            $this->password = CPasswordHelper::hashPassword($this->password);
        }

        return parent::beforeSave();
    }
    /*
     * В зависимости от того новая запись или нет записываем роли и пользователей в таблицу roles_users
     */
    protected function afterSave(){
        if($this->isNewRecord){
            foreach($_POST['UsersCreateForm']['roles'] as $role){
                $roles = new RolesUsers();
                $roles->id_user = $this->id;
                $roles->id_role = $role;
                $roles->save();
            }
        }
        else{
            RolesUsers::model()->deleteAllByAttributes(array('id_user'=>$this->id));
            foreach($_POST['UsersCreateForm']['roles'] as $role){
                $roles = new RolesUsers();
                $roles->id_user = $this->id;
                $roles->id_role = $role;
                $roles->save();
            }
        }

        return parent::afterSave();
    }
}
