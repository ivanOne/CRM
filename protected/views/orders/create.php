<?php

$people = RolesUsers::model()->with('fio')->findAll('id_role=4');
$list = array();
$status = CHtml::listData(Status::model()->findAll(),'id','name');
unset($status[3]);
$list = array();
foreach($people as $pip){
    $list[$pip->fio->id_user] = $pip->fio->fio;
}
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/jquery-ui.min.css')
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery-ui.min.js'),
    CClientScript::POS_HEAD
);

Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/jquery.datetimepicker.css')
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery.datetimepicker.js'),
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/submit.js'),
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScript(
    'chosen','$( "#accordion" ).accordion({
    heightStyle: "content"});',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'checks','
    $(".modalstat").modal("hide");
    $(".can").click(function(){
        $(".modalstat").modal("hide");
    });
    var def = $("#OrdersForm_status").val()
    $("#OrdersForm_status").change(function(){
        if($(this).val() === "2"){
                if($("#OrdersForm_engineer").val() === ""){
                    $(".modalstat").modal("show")
                    $("#OrdersForm_status").val(def)
                }
        }
});',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'auto',' $("#OrdersForm_technics").autocomplete({
    source:"'.Yii::app()->createUrl('ajax/gettech').'"});
    $("#OrdersForm_problem").autocomplete({
    source:"'.Yii::app()->createUrl('ajax/getproblem').'"});
    ',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'form','$("#OrdersForm_status").change(function(){
        var state = $("#OrdersForm_status option:selected").val()
        if(state == 4){
            $(".fail").css("display","block")
        }
        else{
            $(".fail").css("display","none")
        }
    })

    $("#OrdersForm_repair_site").change(function(){
        var site = $("#OrdersForm_repair_site option:selected").val()
        if(site == 2){
             $(".site").css("display","block")
        }
        else{
            $(".site").css("display","none")
        }
    })
    ',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'forms','
    $("#agent input").attr("disabled","disabled")
    $(".agent").change(function(){
        var state = $(".agent").prop("checked");
        if(state){
             $("#agent input").removeAttr("disabled")
             OrdersForm_name1 = $("#OrdersForm_name").val()
             OrdersForm_family1 = $("#OrdersForm_family").val()
             OrdersForm_last_name1 = $("#OrdersForm_last_name").val()
             OrdersForm_city1 = $("#OrdersForm_city").val()
             OrdersForm_street1 = $("#OrdersForm_street").val()
             OrdersForm_home_num1 = $("#OrdersForm_home_num").val()
             OrdersForm_home_apartment1 = $("#OrdersForm_home_apartment").val()
             OrdersForm_home_housing1 = $("#OrdersForm_home_housing").val()
             OrdersForm_home_floor1 = $("#OrdersForm_home_floor").val()
             OrdersForm_home_porch1 = $("#OrdersForm_home_porch").val()
             OrdersForm_telnum1 = $("#OrdersForm_telnum").val()
             $("#OrdersForm_name1").val(OrdersForm_name1)
             $("#OrdersForm_family1").val(OrdersForm_family1)
             $("#OrdersForm_last_name1").val(OrdersForm_last_name1)
             $("#OrdersForm_city1").val(OrdersForm_city1)
             $("#OrdersForm_street1").val(OrdersForm_street1)
             $("#OrdersForm_home_num1").val(OrdersForm_home_num1)
             $("#OrdersForm_home_apartment1").val(OrdersForm_home_apartment1)
             $("#OrdersForm_home_housing1").val(OrdersForm_home_housing1)
             $("#OrdersForm_home_floor1").val(OrdersForm_home_floor1)
             $("#OrdersForm_home_porch1").val(OrdersForm_home_porch1)
             $("#OrdersForm_telnum1").val(OrdersForm_telnum1)

        }
        else{
             $("#agent input").attr("disabled","disabled")
             $("#agent input").val("")


        }
    })',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'calendar','$("#OrdersForm_time").datetimepicker({
  format:"H:i d-m-Y",
  lang:"ru",
});',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'acti','$("#OrdersForm_engineer").change(function(){
        if($(this).val() != ""){
            $("#OrdersForm_status").val("2");
        }
        else{
            $("#OrdersForm_status").val("1");
        }
});',CClientScript::POS_READY
);

$this->layout = "//layouts/column2";
$this->pageTitle = "Создание заказа";
$this->breadcrumbs=array(
    'Заказы'=>array('index'),
    'Создание заказа'
    );
$this->menu=array(
    array('label'=>'Cписок заказов', 'url'=>array('index')),
);
$this->renderPartial('_form',array('model'=>$model,'people'=>$list,'status'=>$status,'pid'=>$pid));
?>
<div role="dialog" class="modal fade bs-example-modal-sm modalstat">

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