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
    width: "400px"})',CClientScript::POS_READY
);
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'View Users', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>Update Users <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_formu', array('forms'=>$forms,'model'=>$model,'roles'=>$roles)); ?>