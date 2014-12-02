<?
$this->html = "<h3 class='text-center'>Заказ #  ".$model->id_abc."</h3>";
$this->layout = "//layouts/column2";
$this->pageTitle = "Редактирование заказа";
$this->breadcrumbs=array(
    'Заказы'=>array('index'),
    'Редактирование заказа'
);
$this->menu=array(
    array('label'=>'Cписок заказов', 'url'=>array('index')),
);
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/jquery-ui.min.css')
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/form.js'),
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery-ui.min.js'),
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/jquery.datetimepicker.css')
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/order_chat.js'));
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery.datetimepicker.js'),
    CClientScript::POS_HEAD
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
    'chosen','$( "#accordion" ).accordion({
    heightStyle: "content"});',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'auto',' $("#OrdersForm_technics").autocomplete({
    source:"'.Yii::app()->createUrl('ajax/gettech').'",});
    $("#OrdersForm_problem").autocomplete({
    source:"'.Yii::app()->createUrl('ajax/getproblem').'"});',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'forrm','
        var state = $("#OrdersForm_status option:selected").val()
        if(state == 4){
            $(".fail").css("display","block")
            $(".fail textarea").attr("disabled",false)
        }
        else{
            $(".fail").css("display","none")
            $(".fail textarea").attr("disabled",true)
        }

        var site = $("#OrdersForm_repair_site option:selected").val()
        if(site == 2){
             $(".site").css("display","block")
             $(".site input").attr("disabled",false)
        }
        else{
            $(".site").css("display","none")
            $(".site input").attr("disabled",true)
        }
    ',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'forms','
    $("#agent input").attr("disabled","disabled")
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
    'fowrm','$("#OrdersForm_status").change(function(){
        var state = $("#OrdersForm_status option:selected").val()
        if(state == 4){
            $(".fail").css("display","block")
            $(".fail textarea").attr("disabled",false)
        }
        else{
            $(".fail").css("display","none")
            $(".site textarea").attr("disabled",true)
        }
    })
    $("#OrdersForm_repair_site").change(function(){
        var site = $("#OrdersForm_repair_site option:selected").val()
        if(site == 2){
             $(".site").css("display","block")
             $(".site input").attr("disabled",false)
        }
        else{
            $(".site").css("display","none")
            $(".site input").attr("disabled",true)
        }
    })
    ',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'calendar','$("#OrdersForm_time").datetimepicker({
  format:"H:i d-m-Y",
  lang:"ru",
});
    render("'.Yii::app()->createUrl('ajax/addchat').'","'.$model->id.'");
',CClientScript::POS_READY
);
$people = RolesUsers::model()->with('fio')->findAll('id_role=4');
$list = array();
$status = CHtml::listData(Status::model()->findAll(),'id','name');
$list = array();
foreach($people as $pip){
    $list[$pip->fio->id_user] = $pip->fio->fio;
}

if($model->status=='1'){
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
    $this->renderPartial("_formUp",array('model'=>$form,'data'=>$model,'people'=>$list,'status'=>$status));
}
if($model->status=='2'){
    $this->renderPartial("_inWork",array('model'=>$form,'data'=>$model,'people'=>$list,'status'=>$status));
}
if($model->status=='3' or $model->status=='4' or $model->status=='5'){
    $this->breadcrumbs=array(
        'Архив'=>array('ArchiveOrder'),
        'Редактирование заказа'
    );
    $this->menu=array(
        array('label'=>'Архив', 'url'=>array('archiveorder')),
    );

    $this->renderPartial("_formArch",array('model'=>$form,'data'=>$model,'people'=>$list,'status'=>$status));
}
    ?>
</div>
</div>

<div role="dialog" class="modal fade bs-example-modal-sm modalstat">

    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">Не верно заполнена форма</h4>
            </div>
            <div class="modal-body">
                <p>Не выбран инженер</p>
                <div class="form-group">
                    <button class="btn btn-primary form-control can">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>