<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm',array(
    'enableAjaxValidation'=>false,
));
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="row">
		<?php echo $form->labelEx($forms,'login'); ?>
		<?php echo $form->textField($forms,'login',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($forms,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($forms,'password'); ?>
		<?php echo $form->passwordField($forms,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($forms,'password'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($forms,'fio'); ?>
        <?php echo $form->textField($forms,'fio',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($forms,'fio'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($forms,'email'); ?>
		<?php echo $form->textField($forms,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($forms,'email'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($forms,'roles'); ?>
        <?php echo $form->listBox($forms,'roles',CHtml::listData(Roles::model()->findAll(),'id','name'),array('class'=>'chosen',
            'multiple'=>'multiple','width'=>'500px')); ?>
        <?php echo $form->error($forms,'roles'); ?>
    </div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Создать пользователя'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->