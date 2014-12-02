<?php

$manageList=RolesUsers::getManager();
$form=$this->beginWidget('CActiveForm',array(
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('role'=>'form')
));
$cura = "";
if($profile->fio->other){
    $curator = json_decode($profile->fio->other);
    $cura = $curator->curator;
}

if($profile->fio->passport){
    $pass = json_decode($profile->fio->passport);
}
?>
<div class="col-lg-12">
    <div class="form-group">
        <?php echo $form->labelEx($model,'fio'); ?>
        <?php echo $form->textField($model,'fio',array('class'=>'form-control','value'=>$profile->fio->fio)); ?>
        <?php echo $form->error($model,'fio'); ?>

        <?php echo $form->labelEx($model,'telephone'); ?>
        <?php echo $form->textField($model,'telephone',array('class'=>'form-control','value'=>$profile->fio->telephone)); ?>
        <?php echo $form->error($model,'telephone'); ?>

        <?php echo $form->labelEx($model,'vydan'); ?>
        <?php echo $form->textField($model,'vydan',array('class'=>'form-control','value'=>$pass->vydan)); ?>
        <?php echo $form->error($model,'vydan'); ?>

        <?php echo $form->labelEx($model,'kod'); ?>
        <?php echo $form->textField($model,'kod',array('class'=>'form-control','value'=>$pass->kod)); ?>
        <?php echo $form->error($model,'kod'); ?>

        <?php echo $form->labelEx($model,'data_v'); ?>
        <?php echo $form->textField($model,'data_v',array('class'=>'form-control','value'=>$pass->data_v)); ?>
        <?php echo $form->error($model,'data_v'); ?>

        <?php echo $form->labelEx($model,'num_pas'); ?>
        <?php echo $form->textField($model,'num_pas',array('class'=>'form-control','value'=>$pass->num_pas)); ?>
        <?php echo $form->error($model,'num_pas'); ?>

        <?php echo $form->labelEx($model,'mesto_r'); ?>
        <?php echo $form->textField($model,'mesto_r',array('class'=>'form-control','value'=>$pass->mesto_r)); ?>
        <?php echo $form->error($model,'mesto_r'); ?>

        <?php echo $form->labelEx($model,'registration'); ?>
        <?php echo $form->textField($model,'registration',array('class'=>'form-control','value'=>$pass->mesto_r)); ?>
        <?php echo $form->error($model,'registration'); ?>

        <?php echo $form->labelEx($model,'mesto_j'); ?>
        <?php echo $form->textField($model,'mesto_j',array('class'=>'form-control','value'=>$profile->fio->propiska)); ?>
        <?php echo $form->error($model,'mesto_j'); ?>

        <?php echo $form->labelEx($model,'dob'); ?>
        <?php echo $form->textField($model,'dob',array('class'=>'form-control','value'=>$profile->fio->dob)); ?>
        <?php echo $form->error($model,'dob'); ?>

        <?php echo $form->labelEx($model,'date_start'); ?>
        <?php echo $form->textField($model,'date_start',array('class'=>'form-control','value'=>$profile->fio->first_day)); ?>
        <?php echo $form->error($model,'date_start'); ?>

        <?php echo $form->labelEx($model,'curator'); ?>
        <?php $model->curator=$cura; ?>
        <?php echo $form->dropDownList($model,'curator',$manageList,array('prompt'=>'','class'=>'form-control'
        )); ?>
        <?php echo $form->error($model,'curator'); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


    <?php $this->endWidget(); ?>
</div>