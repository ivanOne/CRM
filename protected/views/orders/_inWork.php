
<?php
unset($status[1]);
Yii::app()->clientScript->registerScript(
    'check','
    $(".modal").modal("hide");
    $(".can").click(function(){
        $(".modal").modal("hide");
    });
    $("#OrdersForm_get_tech").change(function(){
        if($(this).prop("checked")){
            if(!$("#OrdersForm_profit").val()){
                $(".modal").modal("show");
                $(this).prop("checked",false);
            }else{
                $("#OrdersForm_status").val("3");
            }
        }
});',CClientScript::POS_READY
);
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
<input type='hidden' name='manager' value="<? echo $data->manager?>">
<?
if($data->fio->agent){
    echo "<input type='hidden' name='id_user_ag' value=".$data->fio->agent.">
    <input type='hidden' name='manager' value=".$data->manager.">";
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
            <?php echo $form->labelEx($model,'problem'); ?>
            <?php echo $form->textField($model,'problem',array('size'=>30,'class'=>'form-control','value'=>$data->problem)); ?>
            <?php echo $form->error($model,'problem'); ?>

            <?php echo $form->labelEx($model,'technics'); ?>
            <?php echo $form->textField($model,'technics',array('size'=>30,'class'=>'form-control','value'=>$data->technics)); ?>
            <?php echo $form->error($model,'technics'); ?>

            <?php echo $form->labelEx($model,'returns'); ?>
            <?php echo $form->checkBox($model,'returns',array('size'=>50,'checked'=>($data->returns==1)?true:false)); ?>
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
            <?php echo $form->textField($model,'home_num',array('size'=>4,'maxlength'=>4,'class'=>'form-control','value'=>$home->home_num)); ?>
            <?php echo $form->error($model,'home_num'); ?>

            <?php echo $form->labelEx($model,'home_apartment'); ?>
            <?php echo $form->textField($model,'home_apartment',array('size'=>4,'maxlength'=>4,'class'=>'form-control','value'=>$home->home_apartment)); ?>
            <?php echo $form->error($model,'home_apartment'); ?>

            <?php echo $form->labelEx($model,'home_housing'); ?>
            <?php echo $form->textField($model,'home_housing',array('size'=>4,'maxlength'=>4,'class'=>'form-control','value'=>$home->home_housing)); ?>
            <?php echo $form->error($model,'home_housing'); ?>

            <?php echo $form->labelEx($model,'home_floor'); ?>
            <?php echo $form->textField($model,'home_floor',array('size'=>4,'maxlength'=>4,'class'=>'form-control','value'=>$home->home_floor)); ?>
            <?php echo $form->error($model,'home_floor'); ?>

            <?php echo $form->labelEx($model,'home_porch'); ?>
            <?php echo $form->textField($model,'home_porch',array('size'=>4,'maxlength'=>4,'class'=>'form-control','value'=>$home->home_porch)); ?>
            <?php echo $form->error($model,'home_porch'); ?>

            <?php echo $form->labelEx($model,'intercom'); ?>
            <?php echo $form->textField($model,'intercom',array('size'=>5,'maxlength'=>20,'class'=>'form-control','value'=>$data->fio->intercom)); ?>
            <?php echo $form->error($model,'intercom'); ?>

        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'telnum'); ?>
            <?php echo $form->textField($model,'telnum',array('class'=>'form-control','value'=>$data->fio->telnum)); ?>
            <?php echo $form->error($model,'telnum'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'pasport'); ?>
            <?php echo $form->textField($model,'pasport',array('class'=>'form-control','value'=>$data->fio->pasport)); ?>
            <?php echo $form->error($model,'pasport'); ?>
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
    <h3>Запчасти</h3>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-12 inputList">
                    <?
                    if($data->parts){
                        $count = 0;
                        foreach(json_decode($data->parts) as $key=>$val){
                            $count++;
                            echo "<div idn=".$count." class='row'>
                              <div class='col-lg-7'>
                              <input idn=".$count." value='".$key."' placeholder='Название' type='text' class='form-control' name='partsName[]'>
                              </div><div class='col-lg-3'>
                              <input idn=".$count." value='".$val."' placeholder='Стоимость' type='text' class='form-control' name='partsPrice[]'></div>
                              <div idn='".$count."' id='del' class='col-lg-2 btn btn-danger'>Удалить</div></div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn btn-default" id="add">Добавить</div>
                </div>
            </div>

        </div>
    </div>
    <h3>Чек</h3>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-lg-12 inputListU">
                    <?

                    if($data->service) {
                        $count = 0;
                        foreach (json_decode($data->service) as $it) {
                            if(is_object($it)) {
                                if (isset($it->serv)) {
                                    $check = "";
                                    if(isset($it->discount))
                                        $check = "checked";
                                        $count++;
                                        echo "<div idn=" . $count . " class='row'>
                                      <div class='col-lg-5 col-sm-5'>
                                      <input type='hidden' name=service[" . $count . "][serv]>
                                      <input  idn=" . $count . " value='" . $it->name . "' placeholder='Название' type='text' class='form-control' name='service[" . $count . "][name]'>
                                      </div>
                                      <div class='col-lg-2 col-sm-2 text-right'><span>Скидка </span><input idn=" . $count . " name='service[" . $count . "][discount]' ".$check." type='checkbox'></div>
                                      <div class='col-lg-3 col-sm-3'>
                                      <input idn=" . $count . " value='" . $it->price . "' placeholder='Стоимость' type='text' ln='serv' class='form-control' name='service[" . $count . "][price]'></div>
                                      <div idn='" . $count . "' id='del' class='col-lg-2 col-sm-2 btn btn-danger'>Удалить</div></div>";

                                } else {
                                        $count++;
                                            echo "<div idn=" . $count . " class='row'>
                                      <div class='col-lg-7 col-sm-7'>
                                      <input  idn=" . $count . " value='" . $it->name . "' placeholder='Название' type='text' class='form-control' name='service[".$count."][name]'>
                                      </div><div class='col-lg-3 col-sm-3'>
                                      <input idn=" . $count . " value='" . $it->price . "' placeholder='Стоимость' ln='serv' type='text' class='form-control' name='service[".$count."][price]'></div>
                                      <div idn='" . $count . "' id='del' class='col-lg-2 col-sm-2 btn btn-danger'>Удалить</div></div>";

                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="btn btn-default" id="addU">Добавить</div>
                </div>
                <div class="col-lg-1">
                    <p>Итого:</p>
                </div>
                <? $value = json_decode($data->service);
                $val = "";
                if(isset($value->itog))
                    $val = $value->itog;?>
                <div class="col-lg-3">
                    <input type="text" class="form-control" name="itog" value="<?echo $val;?>" readonly/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 ">
                    <hr class="hr"/>
                </div>
            </div>

        </div>
        <div class="form-inline ">
            <?php echo $form->labelEx($model,'discount'); ?>
            <?php echo $form->textfield($model,'discount',array('class'=>'form-control','value'=>$data->discount)); ?>
            <?php echo $form->error($model,'discount'); ?>

            <?php echo $form->labelEx($model,'total'); ?>
            <?php echo $form->textfield($model,'total',array('class'=>'form-control','value'=>$data->total,'readonly'=>'readonly')); ?>
            <?php echo $form->error($model,'total'); ?>

            <?php echo $form->labelEx($model,'profit'); ?>
            <?php echo $form->textfield($model,'profit',array('class'=>'form-control','value'=>$data->profit,'readonly'=>'readonly')); ?>
            <?php echo $form->error($model,'profit'); ?>
        </div>
        <div class="row">
        <div class="form-group">
            <div class="col-lg-2">
                <div class="btn btn-default" id="refresh">Посчитать</div>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="form-group">
            <?
            $get_tech = array();
            if($data->get_tech != 0){
                $get_tech['checked'] = 'true';
            }

            ?>
            <div class="col-lg-2">
            <?php echo $form->labelEx($model,'get_tech'); ?>
            <?php echo $form->checkbox($model,'get_tech', $get_tech); ?>
            <?php echo $form->error($model,'get_tech'); ?>
            </div>
        </div>
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

<div role="dialog" class="modal fade bs-example-modal-sm">

    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">Не верно заполнена форма</h4>
            </div>
            <div class="modal-body">
                <p>В данном заказе не заполнен чек!</p>
                <div class="form-group">
                    <button class="btn btn-primary form-control can">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>