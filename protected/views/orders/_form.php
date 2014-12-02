
<?php
$this->html = '<h3 class="text-center">Новый заказ # '.$pid.$this->cityIndex.'</h3>';

$form=$this->beginWidget('CActiveForm',array(
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('role'=>'form')
));
?>


    <?php
    if($form->errorSummary($model)){
        echo "<p class='errorMessage'>При сохранении данных найдены ошибки</p>";
    }
     ?>
<div class="form-group">
    <?php echo $form->labelEx($model,'status'); ?>
    <?php echo $form->dropDownList($model,'status',$status,array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'status'); ?>
</div>
<div class="form-group fail">
    <?php echo $form->labelEx($model,'failure'); ?>
    <?php echo $form->textArea($model,'failure',array('size'=>30,'class'=>'form-control')); ?>
    <?php echo $form->error($model,'failure'); ?>
</div>
    <div class="panel-group" id="accordion">
        <h3>Описание заказа</h3>
        <div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'problem'); ?>
                <?php echo $form->textField($model,'problem',array('size'=>30,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'problem'); ?>

                <?php echo $form->labelEx($model,'technics'); ?>
                <?php echo $form->textField($model,'technics',array('size'=>30,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'technics'); ?>

                <?php echo $form->labelEx($model,'returns'); ?>
                <?php echo $form->checkBox($model,'returns',array('size'=>50)); ?>
                <?php echo $form->error($model,'returns'); ?>

            </div>
        </div>
        <h3>Клиент</h3>
            <div>
                <div class="form-inline">
                    <?php echo $form->labelEx($model,'family'); ?>
                    <?php echo $form->textField($model,'family',array('size'=>20,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'family'); ?>

                    <?php echo $form->labelEx($model,'name'); ?>
                    <?php echo $form->textField($model,'name',array('size'=>20,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'name'); ?>

                    <?php echo $form->labelEx($model,'last_name'); ?>
                    <?php echo $form->textField($model,'last_name',array('size'=>20,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'last_name'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'city'); ?>
                    <?php echo $form->textField($model,'city',array('class'=>'form-control','value'=>'Киров')); ?>
                    <?php echo $form->error($model,'city'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'street'); ?>
                    <?php echo $form->textField($model,'street',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'street'); ?>
                </div>
                <div class="form-inline">
                    <?php echo $form->labelEx($model,'home_num'); ?>
                    <?php echo $form->textField($model,'home_num',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'home_num'); ?>

                    <?php echo $form->labelEx($model,'home_apartment'); ?>
                    <?php echo $form->textField($model,'home_apartment',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'home_apartment'); ?>

                    <?php echo $form->labelEx($model,'home_housing'); ?>
                    <?php echo $form->textField($model,'home_housing',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'home_housing'); ?>

                    <?php echo $form->labelEx($model,'home_floor'); ?>
                    <?php echo $form->textField($model,'home_floor',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'home_floor'); ?>

                    <?php echo $form->labelEx($model,'home_porch'); ?>
                    <?php echo $form->textField($model,'home_porch',array('size'=>2,'maxlength'=>2,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'home_porch'); ?>

                    <?php echo $form->labelEx($model,'intercom'); ?>
                    <?php echo $form->textField($model,'intercom',array('size'=>5,'maxlength'=>20,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'intercom'); ?>

                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'telnum'); ?>
                    <?php echo $form->textField($model,'telnum',array('class'=>'form-control','value'=>'8')); ?>
                    <?php echo $form->error($model,'telnum'); ?>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'pasport'); ?>
                        <?php echo $form->textField($model,'pasport',array('class'=>'form-control','value'=>$data->fio->pasport)); ?>
                        <?php echo $form->error($model,'pasport'); ?>
                    </div>
                </div>
                <div class="form-inline">
                    <?php echo $form->labelEx($model,'email'); ?>
                    <?php echo $form->textField($model,'email',array('size'=>25,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'email'); ?>

                    <?php echo $form->labelEx($model,'index'); ?>
                    <?php echo $form->textField($model,'index',array('size'=>25,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'index'); ?>
                </div>
                </div>
                <h3>Представитель клиента</h3>

                <div>
                    <div class="form-group">
                        <input type="checkbox" name="ag" class="agent"/>
                        <label>Активировать группу полей</label>
                    </div>
                    <div id="agent">
                    <div class="form-inline">
                        <?php echo $form->labelEx($model,'family1'); ?>
                        <?php echo $form->textField($model,'family1',array('size'=>20,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'family1'); ?>

                        <?php echo $form->labelEx($model,'name1'); ?>
                        <?php echo $form->textField($model,'name1',array('size'=>20,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'name1'); ?>

                        <?php echo $form->labelEx($model,'last_name1'); ?>
                        <?php echo $form->textField($model,'last_name1',array('size'=>20,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'last_name1'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'city1'); ?>
                        <?php echo $form->textField($model,'city1',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'city1'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'street1'); ?>
                        <?php echo $form->textField($model,'street1',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'street1'); ?>
                    </div>
                    <div class="form-inline">
                        <?php echo $form->labelEx($model,'home_num1'); ?>
                        <?php echo $form->textField($model,'home_num1',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'home_num1'); ?>

                        <?php echo $form->labelEx($model,'home_apartment1'); ?>
                        <?php echo $form->textField($model,'home_apartment1',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'home_apartment1'); ?>

                        <?php echo $form->labelEx($model,'home_housing1'); ?>
                        <?php echo $form->textField($model,'home_housing1',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'home_housing1'); ?>

                        <?php echo $form->labelEx($model,'home_floor1'); ?>
                        <?php echo $form->textField($model,'home_floor1',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'home_floor1'); ?>

                        <?php echo $form->labelEx($model,'home_porch1'); ?>
                        <?php echo $form->textField($model,'home_porch1',array('size'=>4,'maxlength'=>4,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'home_porch1'); ?>

                    </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'telnum1'); ?>
                    <?php echo $form->textField($model,'telnum1',array('class'=>'form-control','value'=>'8')); ?>
                    <?php echo $form->error($model,'telnum1'); ?>
                </div>
                    </div>
            </div>

    <h3>Исполнители</h3>
        <div>
    <div class="form-inline">
        <?php echo $form->labelEx($model,'courier'); ?>
        <?php echo $form->dropDownList($model,'courier',$people,array('class'=>'form-control','empty'=>'')); ?>
        <?php echo $form->error($model,'courier'); ?>

        <?php echo $form->labelEx($model,'engineer'); ?>
        <?php echo $form->dropDownList($model,'engineer',$people,array('class'=>'form-control','empty'=>'')); ?>
        <?php echo $form->error($model,'engineer'); ?>
    </div>
        </div>
    <h3>Реклама</h3>
    <div class="form-group">
        <?php echo $form->labelEx($model,'source'); ?>
        <?php echo $form->dropDownList($model,'source',CHtml::listData(Source::model()->findAll(),'id','name'),array('class'=>'form-control',
        'options'=>array('13'=>array('selected'=>'selected')))); ?>
        <?php echo $form->error($model,'source'); ?>
    </div>
        <h3>Место проведения ремонта</h3>
        <div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'repair_site'); ?>
                <?php echo $form->dropDownList($model,'repair_site',array('1'=>'Офис','2'=>'Выезд'),array('class'=>'form-control')); ?>
                <?php echo $form->error($model,'repair_site'); ?>
            </div>
            <div class="form-group site">
                <?php echo $form->labelEx($model,'time'); ?>
                <?php echo $form->textField($model,'time',array('class'=>'form-control','readonly'=>'readonly')); ?>
                <?php echo $form->error($model,'time'); ?>
            </div>
        </div>

    </div>
<div class="form-group">
    <?php echo CHtml::submitButton('Создать заказ'); ?>
</div>


<?php $this->endWidget(); ?>

</div>