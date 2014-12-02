<?php
$regionList = CHtml::listData(AdsRegion::model()->findAll(),'id','name');
?>

<?
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'=>array("ads/adsmenu"),
    'Журнал расклейки'
);
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery.datetimepicker.js'),
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/jquery.datetimepicker.css')
);
Yii::app()->clientScript->registerScript(
    'adscal','
    $("#start, #end").datetimepicker({
        format:"d-m-Y",
        lang:"ru",
        timepicker:false});
    ',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'adsarch','
    $("select").live("change",function(){
       var ini = $(this).attr("ini");
       region = $(this).val();
       if(region == ""){
            $(".adsMan[ini="+ini+"]").empty();
            $(".adsPay[ini="+ini+"]").empty();
       }
       else{
           $.ajax({
                url:"'.Yii::app()->createUrl('adsarch/adsgetinfo').'",
                data:"region="+region,
                success: (function(data){
                    if(data){
                        $(".adsMan[ini="+ini+"]").text("");
                        $(".adsMan[ini="+ini+"]").text(data);
                        $(".adsPay[ini="+ini+"]").html("<input type=checkbox class=inPay ini="+ini+">");
                    }
                    else{
                        $(".adsMan[ini="+ini+"]").empty();
                        $(".adsPay[ini="+ini+"]").html("<input type=checkbox class=inArch ini="+ini+">");
                    }
                }),
            });
       }

    });
    ',CClientScript::POS_READY
);
Yii::app()->clientScript->registerScript(
    'adsarch1','
        function renderRow(obj){
                var select = "<select id=region ini="+obj.id+" class=form-control name=region><option value=></option>";
                var row = "";
                $(".list option").each(function(){
                   val = $(this).attr("value");
                   text = $(this).text();
                   if(val == obj.region){
                        select += "<option selected value="+val+">"+text+"</option>";
                   }
                   else{
                        select += "<option value="+val+">"+text+"</option>";
                   }
                });
                select += "</select>";
                row += "<td class=adsid>"+obj.id_abc+"</td>";
                row += "<td class=adsaddr>"+obj.addr+"</td>";
                row += "<td class=adsdate>"+obj.date+"</td>";
                row += "<td>"+select+"</td>";
                if(obj.pay == 0){
                    row += "<td class=adsMan ini="+obj.id+"></td>";
                    row += "<td class=adsPay ini="+obj.id+"><input class=inArch ini="+obj.id+" type=checkbox></td>";
                }
                else{
                    row += "<td class=adsMan ini="+obj.id+">"+obj.ads+"</td>";
                    row += "<td class=adsPay ini="+obj.id+"><input class=inPay ini="+obj.id+" type=checkbox></td>";
                }
                return row;
        }
        $(".inPay").live("click",function(){
            var row = "";

            if($(this).prop("checked")){
                var int = $(this).attr("ini");
                id = int;
                id_abc = $(".architem[ini="+int+"] .adsid").text();
                addr = $(".architem[ini="+int+"] .adsaddr").text();
                date = $(".architem[ini="+int+"] .adsdate").text();
                region = $("#region[ini="+int+"]").val();
                adsman = $(".architem[ini="+int+"] .adsMan").text();
                pay = 1;
                $.ajax({
                url:"'.Yii::app()->createUrl("adsarch/adstoarch").'",
                data:{"id_abc":id_abc,"id":id,"addr":addr,"date":date,"region":region,"adsman":adsman,"pay":pay},
                success: (function(){
                    $(".architem[ini="+int+"]").html("<td colspan=6><p>Заказ в архиве</p><span ini="+int+" class=ret>Вернуть</span></td>");
                }),
            });
            }
        });
        $(".inArch").live("click",function(){
            if($(this).prop("checked")){
                var int = $(this).attr("ini");
                id = int;
                id_abc = $(".architem[ini="+int+"] .adsid").text();
                addr = $(".architem[ini="+int+"] .adsaddr").text();
                date = $(".architem[ini="+int+"] .adsdate").text();
                region = $("#region[ini="+int+"]").val();
                adsman = "null";
                pay = 0;
                $.ajax({
                url:"'.Yii::app()->createUrl("adsarch/adstoarch").'",
                data:{"id_abc":id_abc,"id":id,"addr":addr,"date":date,"region":region,"adsman":adsman,"pay":pay},
                success: (function(){
                    $(".architem[ini="+int+"]").html("<td colspan=6><p>Заказ в архиве</p><span ini="+int+" class=ret>Вернуть</span></td>");
                    })
                });
            }
        });
        $(".ret").live("click",function(){
            var id = $(this).attr("ini");
             $.ajax({
                url:"'.Yii::app()->createUrl("adsarch/adsofarch").'",
                data:{"id":id},
                success: (function(data){
                    var str = jQuery.parseJSON(data);
                    var row = renderRow(str);
                    $(".architem[ini="+str.id+"]").html(row);
                    })
                });
        })



    ',CClientScript::POS_READY
);
?>
<div class="list" id="hid">
    <?
        foreach($regionList as $val => $text){
            echo "<option value=".$val.">".$text."</option>";
        }
    ?>
</div>
<?
    $this->html = '<div class="form-inline">';
    $this->html .= CHtml::beginForm(Yii::app()->createUrl('adsarch/adsarchlist'),'get');
    $this->html .= CHtml::textField('start',$start,array('placeholder'=>"С","class"=>"form-control"));
    $this->html .= CHtml::textField('end',$end,array('placeholder'=>"ПО","class"=>"form-control"));
    $this->html .= CHtml::submitButton('Найти',array("class"=>"btn btn-primary form-control"));
    $this->html .= CHtml::endForm();
    $this->html .= '</div>';
?>
<?
$this->layout = "//layouts/column2";
$this->menu=array(
    array('label'=>'Архив','url'=>Yii::app()->createUrl("adsarch/adsarchviews"))
);
$this->widget('ListView',array(
    'dataProvider'=>$data,
    'itemView'=>'_view',
    'ajaxUpdate' => false,
    'summaryText'=>"",
    'itemsTagName'=>'table',
    'itemsCssClass'=>'table table-bordered',
    'header'=>array('#','Адрес','Дата заказа','Район','Расклейщик','Оплачено или в архив'),
    'pager'=>array('header'=>false,'htmlOptions'=>array('class'=>'pagination'),
        'nextPageLabel'=>'>','lastPageLabel'=>'>>','prevPageLabel'=>'<','firstPageLabel'=>'<<',
        'selectedPageCssClass'=>'active',
    ),
    'emptyText'=>'Ничего не найдено',
    'htmlOptions'=>array('id'=>'adsArch')

));
?>