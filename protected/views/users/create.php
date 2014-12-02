<?php
/* @var $this UsersController */
/* @var $model Users */
Yii::app()->clientScript->registerCssFile(
   CHtml::asset(Yii::app()->request->baseUrl.'css/chosen.css')
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/chosen.jquery.min.js'),
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScript(
    'chosen','$(".chosen").chosen({
    width:"400px"})',CClientScript::POS_READY
);
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),
	array('label'=>'Управление пользователями', 'url'=>array('admin')),
);
?>

<h1>Создать пользователя</h1>

<?php $this->renderPartial('_form', array('forms'=>$forms)); ?>

