<?
$this->layout = "//layouts/column2";
$this->menu=array(
    array('label'=>'Удалить', 'url'=>array('adsregion/regiondelete','id'=>$model->id))
);
$form=$this->beginWidget('CActiveForm',array(
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('role'=>'form','id'=>'RF')
));
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'=>array("ads/adsmenu"),
    'Список районов'=>array("adsregion/regionlist"),
    'Редактирование'
);
?>
<div class="col-lg-12">
    <div class="form-group">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('class'=>'form-control','value'=>$model->name)); ?>
        <?php echo $form->error($model,'name'); ?>

        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textField($model,'description',array('class'=>'form-control','value'=>$model->description)); ?>
        <?php echo $form->error($model,'description'); ?>

    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


    <?php $this->endWidget(); ?>
</div>