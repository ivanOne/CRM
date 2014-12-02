<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>
<div class='col-lg-12'>
<h1 class="text-center">Вход</h1>

<p class="text-center">Введите свой логин и пароль</p>

<div class="col-lg-12">
    <div class="row">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

        <p class="text-center">Поля с символом <span class="required">*</span> Обязательны для заполнения.</p>
        <div class="col-lg-2 col-lg-offset-5">
            <div class="form-group">
                <?php echo $form->labelEx($model,'username'); ?>
                <?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'username'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model,'password'); ?>
                <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>

            <div class="form-group">
                <?php echo CHtml::submitButton("Вход",array('class'=>'btn btn-info form-control')); ?>
            </div>

        <?php $this->endWidget(); ?>
        </div>
    </div>
</div><!-- form -->
</div>