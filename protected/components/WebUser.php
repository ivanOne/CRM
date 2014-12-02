<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 24.09.2014
 * Time: 12:51
 */

class WebUser extends CWebUser
{
    public function checkAccess($operation, $params=array())
    {
        if (empty($this->id)) {
            return false;
        }
        $role = $this->getState("role");
        return ($operation === $role);
    }
} 