<?php
$this->layout = "//layouts/column2";
$this->menu=array(
    array('label'=>'Создать отчет','itemOptions'=>array('class'=>"createDailyreport",'data-toggle'=>"modal",'data-target'=>".pop"))
);
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'=>array("ads/adsmenu"),
    'Ежедневные отчеты'
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery.maskedinput.min.js'),
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScript(
    'razz','
$(".can").click(function(){
    $(".pop").modal("hide");
    $(".popans").modal("hide");
    $(".popans").removeAttr("date");
    $("#date").mask("99.99.9999");

});
$("[cli=1]").click(function(){
    var dates = $(this).attr("date");
    if($(this).attr("class") == "yes"){
        var dates = $(this).attr("date");
        document.location.href = "'.Yii::app()->createUrl("adsbase/dailyreportview").'&date="+dates+"";
    }
    else{
        $(".popans").modal("show");
        $(".popans").attr("date",dates);
    }
    $(".tru").click(function(){
        document.location.href = "'.Yii::app()->createUrl("adsbase/dailyreportcreate").'&date="+dates+"";
    });
});
',CClientScript::POS_READY
);
$month = array('01'=>'Январь','02'=>'Февраль','03'=>'Март','04'=>'Апрель','05'=>'Май','06'=>'Июнь','07'=>'Июль',
    '08'=>'Август','09'=>'Сентябрь','10'=>'Октябрь','11'=>'Ноябрь',"12"=>"Декабрь");
$m = date("m",strtotime($now."-01"));
$y = date("Y",strtotime($now."-01"));
$this->html = '<div class="row">';
$this->html .= '<div class="col-lg-2">';
$this->html .= '<a href="'. Yii::app()->createUrl("adsbase/dailyreportlist",array('date'=>$pre)).'"><<</a>';
$this->html .= '</div>';
$this->html .= '<div class="col-lg-8 text-center">';
$this->html .= $month[$m]." ".$y;
$this->html .= '</div>';
$this->html .= '<div class="col-lg-2 text-right">';
$this->html .= '<a href="'.Yii::app()->createUrl("adsbase/dailyreportlist",array('date'=>$next)).'">>></a>';
$this->html .= '</div>';
$this->html .= '</div>';

?>

        <?
        $this->drawCalendar($m,$y,$dates);
        ?>
<div role="dialog" class="modal fade bs-example-modal-sm pop">

    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">Создание отчета</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <? $date = date("d.m.Y",time()); ?>
                    <?= CHtml::beginForm(array("adsbase/dailyreportcreate"),"get");?>
                    <?= CHtml::textField('date',$date,array("class"=>"form-control")); ?>
                </div>
                <div class="form-group">
                    <?= CHtml::submitButton("Создать",array("class"=>"btn btn-primary form-control"));?>
                    <?= CHtml::endForm(); ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger form-control can">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div role="dialog" class="modal fade bs-example-modal-sm popans">

    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-center">Создать отчет?</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <button class="btn btn-primary form-control tru">Создать</button>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger form-control can">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>