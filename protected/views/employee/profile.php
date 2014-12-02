<?php
$this->html = '<h2 class="text-center">Карточка сотрудника - '.$profile->fio->fio.'</h2>';
$this->layout = "//layouts/column2";
$this->menu=array(
    array('label'=>'Вернуться к списку', 'url'=>array('employee/employeelist')),
    array('label'=>'Редактировать', 'url'=>array('employee/employeeupdate','id'=>$profile->id_user)),
    array('label'=>'Отчет по сотруднику', 'url'=>array('employee/employeereport','id'=>$profile->id_user,'name'=>$profile->fio->fio))
);
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Список сотрудников'=>array('employeelist'),
    'Профиль сотрудника'
);
$view = "";
switch($profile->id_role){
    case 4:
        $view = '_enginProfile';
        break;
    case 3:
        $view = '_manageProfile';
        break;
    case 5:
        $view = '_manageProfile';
        break;
}
$this->renderPartial($view,array('profile'=>$profile));
