<?php

class UserIdentity extends CUserIdentity
{
    public function authenticate()
    {
        $record=Users::model()->findByAttributes(array('login'=>$this->username));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!CPasswordHelper::verifyPassword($this->password,$record->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $role=RolesUsers::model()->findByAttributes(array('id_user'=>$record->id));
            $this->setState('id',$record->id);
            $role = $role->id_role;
            $this->setState('role', $role);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

}