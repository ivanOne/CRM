<?
$this->layout = "//layouts/column2";
$this->menu=array(
    array('label'=>'Список сотрудников', 'url'=>array('employee/employeelist'))
);
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Список сотрудников'=>array('employeelist'),
    'Профиль сотрудника'=>array('employeeprofile','id'=>$profile->id_user),
    'Обновление профиля'
);
$view="";
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery.maskedinput.min.js'),
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScript(
    'masked','$("#EmployeeForm_data_v,#EmployeeForm_dob,#EmployeeForm_date_start").mask("99.99.9999");
            $("#EmployeeForm_num_pas").mask("99-99-999999");
            $("#EmployeeForm_data_v").mask("99.99.9999");',CClientScript::POS_READY
);
switch($profile->id_role){
    case 4:
        $view = '_enginForm';
        break;
    case 3:
        $view = '_manageForm';
        break;
    case 5:
        $view = '_manageForm';
        break;
}

?>


<div class="col-lg-12">
    <? $this->html = "<h2 class='text-center'>Обновление данных сотрудника -  ".$profile->fio->fio."</h2>";?>
    <? $this->renderPartial($view,array('profile'=>$profile,'model'=>$form));?>
</div>