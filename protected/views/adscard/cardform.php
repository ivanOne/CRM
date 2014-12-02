<?
$this->layout = "//layouts/column2";
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery.maskedinput.min.js'),
    CClientScript::POS_HEAD
);
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'=>array("ads/adsmenu"),
    'Список расклейщиков'=>array('adscard/adscards'),
    'Новый расклещик'
);
Yii::app()->clientScript->registerScript(
    'masked','$("#AdsCardForm_data_v,#AdsCardForm_dob,#AdsCardForm_date_start").mask("99.99.9999");
            $("#AdsCardForm_num_pas").mask("99-99-999999");
            $("#AdsCardForm_data_v").mask("99.99.9999");',CClientScript::POS_READY
);
$this->layout = "//layouts/column2";
$this->menu=array(
array('label'=>'Список карточек расклейщиков', 'url'=>array('adscard/adscards'))
);
$form=$this->beginWidget('CActiveForm',array(
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('role'=>'form','id'=>'CF')
));
?>
<div class="col-lg-12">
    <div class="form-group">
        <?php echo $form->labelEx($model,'fio'); ?>
        <?php echo $form->textField($model,'fio',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'fio'); ?>

        <?php echo $form->labelEx($model,'telephone'); ?>
        <?php echo $form->textField($model,'telephone',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'telephone'); ?>

        <?php echo $form->labelEx($model,'vydan'); ?>
        <?php echo $form->textField($model,'vydan',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'vydan'); ?>

        <?php echo $form->labelEx($model,'kod'); ?>
        <?php echo $form->textField($model,'kod',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'kod'); ?>

        <?php echo $form->labelEx($model,'data_v'); ?>
        <?php echo $form->textField($model,'data_v',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'data_v'); ?>

        <?php echo $form->labelEx($model,'num_pas'); ?>
        <?php echo $form->textField($model,'num_pas',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'num_pas'); ?>

        <?php echo $form->labelEx($model,'mesto_r'); ?>
        <?php echo $form->textField($model,'mesto_r',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'mesto_r'); ?>

        <?php echo $form->labelEx($model,'registration'); ?>
        <?php echo $form->textField($model,'registration',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'registration'); ?>

        <?php echo $form->labelEx($model,'mesto_j'); ?>
        <?php echo $form->textField($model,'mesto_j',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'mesto_j'); ?>

        <?php echo $form->labelEx($model,'dob'); ?>
        <?php echo $form->textField($model,'dob',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'dob'); ?>

        <?php echo $form->labelEx($model,'date_start'); ?>
        <?php echo $form->textField($model,'date_start',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'date_start'); ?>

    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


    <?php $this->endWidget(); ?>
</div>
