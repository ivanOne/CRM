<?php
/* @var $this UsersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Сотрудники',
);

$this->menu=array(
	array('label'=>'Создать нового сотрудника', 'url'=>array('create')),
	array('label'=>'Управление сотрудниками', 'url'=>array('admin')),
);
?>

<h1>Сотрудники</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
