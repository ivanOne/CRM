
    <?php
    unset($status[3]);
    $form=$this->beginWidget('CActiveForm',array(
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('role'=>'form','id'=>'read'),
        'action'=>array('orders/update')
    ));

    $time = null;
    if(($data->time == null) or ($data->time == "0000-00-00 00:00:00")){
        $time = null;
    }else{
        $time = date("H:i d-m-Y",strtotime($data->time));
    }
    ?>
    <input type="hidden" name="id" value="<? echo $data->id ?>"/>
    <input type="hidden" name="id_user" value="<? echo $data->customer ?>"/>
    <input type='hidden' name='manager' value="<? echo $data->manager ?>">
    <?
    if($data->fio->agent){
        echo "<input type='hidden' name='id_user_ag' value=".$data->fio->agent.">";
    }
    ?>

    <?php
    if($form->errorSummary($model)){
        echo "<p class='errorMessage'>При сохранении данных найдены ошибки</p>";
    }
    ?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',$status,array('class'=>'form-control','options'=>array($data->status=>array('selected'=>true)))); ?>
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
                <? $return = "";
                if($data->returns){
                    $return="true";
                }
                ?>
                <?php echo $form->labelEx($model,'problem'); ?>
                <?php echo $form->textField($model,'problem',array('size'=>30,'class'=>'form-control','value'=>$data->problem)); ?>
                <?php echo $form->error($model,'problem'); ?>

                <?php echo $form->labelEx($model,'technics'); ?>
                <?php echo $form->textField($model,'technics',array('size'=>30,'class'=>'form-control','value'=>$data->technics)); ?>
                <?php echo $form->error($model,'technics'); ?>

                <?php echo $form->labelEx($model,'returns'); ?>
                <?php echo $form->checkBox($model,'returns',array('size'=>50,'checked'=>$return)); ?>
                <?php echo $form->error($model,'returns'); ?>
            </div>
        </div>
        <h3>Клиент</h3>
        <? $customer = explode(" ",$data->fio->fio);
           $home = json_decode($data->fio->home);?>

        <div>
            <div class="form-inline">
                <?php echo $form->labelEx($model,'family'); ?>
                <?php echo $form->textField($model,'family',array('size'=>25,'class'=>'form-control','value'=>$customer[1])); ?>
                <?php echo $form->error($model,'family'); ?>

                <?php echo $form->labelEx($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>25,'class'=>'form-control','value'=>$customer[0])); ?>
                <?php echo $form->error($model,'name'); ?>

                <?php echo $form->labelEx($model,'last_name'); ?>
                <?php echo $form->textField($model,'last_name',array('size'=>25,'class'=>'form-control','value'=>$customer[2])); ?>
                <?php echo $form->error($model,'last_name'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'city'); ?>
                <?php echo $form->textField($model,'city',array('class'=>'form-control','value'=>$data->fio->city)); ?>
                <?php echo $form->error($model,'city'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'street'); ?>
                <?php echo $form->textField($model,'street',array('class'=>'form-control','value'=>$data->fio->street)); ?>
                <?php echo $form->error($model,'street'); ?>
            </div>
            <div class="form-inline">
                <?php echo $form->labelEx($model,'home_num'); ?>
                <?php echo $form->textField($model,'home_num',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$home->home_num)); ?>
                <?php echo $form->error($model,'home_num'); ?>

                <?php echo $form->labelEx($model,'home_apartment'); ?>
                <?php echo $form->textField($model,'home_apartment',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$home->home_apartment)); ?>
                <?php echo $form->error($model,'home_apartment'); ?>

                <?php echo $form->labelEx($model,'home_housing'); ?>
                <?php echo $form->textField($model,'home_housing',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$home->home_housing)); ?>
                <?php echo $form->error($model,'home_housing'); ?>

                <?php echo $form->labelEx($model,'home_floor'); ?>
                <?php echo $form->textField($model,'home_floor',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$home->home_floor)); ?>
                <?php echo $form->error($model,'home_floor'); ?>

                <?php echo $form->labelEx($model,'home_porch'); ?>
                <?php echo $form->textField($model,'home_porch',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$home->home_porch)); ?>
                <?php echo $form->error($model,'home_porch'); ?>

                <?php echo $form->labelEx($model,'intercom'); ?>
                <?php echo $form->textField($model,'intercom',array('size'=>5,'maxlength'=>20,'class'=>'form-control','value'=>$data->fio->intercom)); ?>
                <?php echo $form->error($model,'intercom'); ?>

            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'telnum'); ?>
                <?php echo $form->textField($model,'telnum',array('class'=>'form-control','value'=>$data->fio->telnum)); ?>
                <?php echo $form->error($model,'telnum'); ?>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'pasport'); ?>
                    <?php echo $form->textField($model,'pasport',array('class'=>'form-control','value'=>$data->fio->pasport)); ?>
                    <?php echo $form->error($model,'pasport'); ?>
                </div>

            </div>
            <div class="form-inline">
                <?php echo $form->labelEx($model,'email'); ?>
                <?php echo $form->textField($model,'email',array('size'=>25,'class'=>'form-control','value'=>$data->fio->email)); ?>
                <?php echo $form->error($model,'email'); ?>

                <?php echo $form->labelEx($model,'index'); ?>
                <?php echo $form->textField($model,'index',array('size'=>25,'class'=>'form-control','value'=>$home->index)); ?>
                <?php echo $form->error($model,'index'); ?>
            </div>
        </div>
        <h3>Представитель клиента</h3>

        <div>
            <div class="form-group">
                <? $checked = "";
                if($data->fio->agent){
                    $checked="checked";
                    $agent = Customers::model()->findByPk($data->fio->agent);
                    $fio1 = explode(" ",$agent->fio);
                    $home1 = json_decode($agent->home);
                }
                ?>
                <input type="checkbox" name="ag" class="agent" <?echo $checked;?> />
                <label>Активировать группу полей</label>
            </div>
            <div id="agent">
                <div class="form-inline">

                    <?php echo $form->labelEx($model,'family1'); ?>
                    <?php echo $form->textField($model,'family1',array('size'=>25,'class'=>'form-control','value'=>$data->fio->agent?$fio1[1]:false)); ?>
                    <?php echo $form->error($model,'family1'); ?>

                    <?php echo $form->labelEx($model,'name1'); ?>
                    <?php echo $form->textField($model,'name1',array('size'=>25,'class'=>'form-control','value'=>$data->fio->agent?$fio1[0]:false)); ?>
                    <?php echo $form->error($model,'name1'); ?>

                    <?php echo $form->labelEx($model,'last_name1'); ?>
                    <?php echo $form->textField($model,'last_name1',array('size'=>25,'class'=>'form-control','value'=>$data->fio->agent?$fio1[2]:false)); ?>
                    <?php echo $form->error($model,'last_name1'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'city1'); ?>
                    <?php echo $form->textField($model,'city1',array('class'=>'form-control','value'=>$data->fio->agent?$agent->city:false)); ?>
                    <?php echo $form->error($model,'city1'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'street1'); ?>
                    <?php echo $form->textField($model,'street1',array('class'=>'form-control','value'=>$data->fio->agent?$agent->street:false)); ?>
                    <?php echo $form->error($model,'street1'); ?>
                </div>
                <div class="form-inline">
                    <?php echo $form->labelEx($model,'home_num1'); ?>
                    <?php echo $form->textField($model,'home_num1',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$data->fio->agent?$home1->home_num:false)); ?>
                    <?php echo $form->error($model,'home_num1'); ?>

                    <?php echo $form->labelEx($model,'home_apartment1'); ?>
                    <?php echo $form->textField($model,'home_apartment1',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$data->fio->agent?$home1->home_apartment:false)); ?>
                    <?php echo $form->error($model,'home_apartment1'); ?>

                    <?php echo $form->labelEx($model,'home_housing1'); ?>
                    <?php echo $form->textField($model,'home_housing1',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$data->fio->agent?$home1->home_housing:false)); ?>
                    <?php echo $form->error($model,'home_housing1'); ?>

                    <?php echo $form->labelEx($model,'home_floor1'); ?>
                    <?php echo $form->textField($model,'home_floor1',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$data->fio->agent?$home1->home_floor:false)); ?>
                    <?php echo $form->error($model,'home_floor1'); ?>

                    <?php echo $form->labelEx($model,'home_porch1'); ?>
                    <?php echo $form->textField($model,'home_porch1',array('size'=>2,'maxlength'=>2,'class'=>'form-control','value'=>$data->fio->agent?$home1->home_porch:false)); ?>
                    <?php echo $form->error($model,'home_porch1'); ?>

                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'telnum1'); ?>
                    <?php echo $form->textField($model,'telnum1',array('class'=>'form-control','value'=>$data->fio->agent?$agent->telnum:false)); ?>
                    <?php echo $form->error($model,'telnum1'); ?>
                </div>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'pasport1'); ?>
                    <?php echo $form->textField($model,'pasport1',array('class'=>'form-control','vlaue'=>$data->fio->agent?$agent->pasport:false)); ?>
                    <?php echo $form->error($model,'pasport1'); ?>
                </div>
            </div>
        </div>

        <h3>Исполнители</h3>
        <div>
            <div class="form-inline">
                <?php echo $form->labelEx($model,'courier'); ?>
                <?php echo $form->dropDownList($model,'courier',$people,array('empty'=>'','class'=>'form-control','options'=>array($data->courier=>array('selected'=>true)))); ?>
                <?php echo $form->error($model,'courier'); ?>

                <?php echo $form->labelEx($model,'engineer'); ?>
                <?php echo $form->dropDownList($model,'engineer',$people,array('empty'=>'','class'=>'form-control','options'=>array($data->engineer=>array('selected'=>true)))); ?>
                <?php echo $form->error($model,'engineer'); ?>
            </div>
        </div>
        <h3>Реклама</h3>
        <div class="form-group">
            <?php echo $form->labelEx($model,'source'); ?>
            <?php echo $form->dropDownList($model,'source',CHtml::listData(Source::model()->findAll(),'id','name'),array('class'=>'form-control','options'=>array($data->source=>array('selected'=>true)))); ?>
            <?php echo $form->error($model,'source'); ?>
        </div>
        <h3>Место проведения ремонта</h3>
        <div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'repair_site'); ?>
                <?php echo $form->dropDownList($model,'repair_site',array('1'=>'Офис','2'=>'Выезд'),array('class'=>'form-control','options'=>array($data->repair_site=>array('selected'=>true)))); ?>
                <?php echo $form->error($model,'repair_site'); ?>
            </div>
            <div class="form-group site">
                <?php echo $form->labelEx($model,'time'); ?>
                <?php echo $form->textField($model,'time',array('class'=>'form-control','value'=>$time,'readonly'=>'readonly')); ?>
                <?php echo $form->error($model,'time'); ?>
            </div>
        </div>

        <h3>Комментарии</h3>
        <div>
            <div id="order_chat">

            </div>
            <div class="form-group">
                <?php echo CHtml::label("Сообщение","chat_inp"); ?>
                <?php echo CHtml::textArea('chat_inp',"",array('class'=>"form-control")); ?>
            </div>
            <div class="form-group">
                <div class="btn btn-danger" id="chat_but" onclick="add('<?= Yii::app()->user->id?>','<?= Yii::app()->createUrl('ajax/addchat')?>','<?= $data->id ?>')">Отправить</div>
            </div>

        </div>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


    <?php $this->endWidget(); ?>
