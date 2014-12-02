<?php
$this->layout = "//layouts/column2";
$this->pageTitle = "Отчет по расклейке";
$this->breadcrumbs=array(
    'Заказы'=>array('orders/index'),
    'Ежедневный отчет'
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
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript(
    'todayReport','
        $("a.btn").each(function(){
            if (this.href == document.URL) {
			    $(this).addClass("active");
		}
        });
    ',CClientScript::POS_READY
);

$this->widgetClass = "search";
$this->html = CHtml::beginForm(Yii::app()->createUrl('advert/advertads'),'get');
$this->html .= '<div class="form-inline">';
$this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("advert/advertads",array('time' => '1')).'">
                Сегодня
            </a>';
$this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("advert/advertads",array('time' => '4')).'">
                Вчера
            </a>';
$this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("advert/advertads",array('time' => '2')).'">
                Неделя
            </a>';
$this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("advert/advertads",array('time' => '3')).'">
                Месяц
            </a>';
$this->html .= CHtml::textField('start',$start,array('placeholder'=>"С","class"=>"form-control",'readonly'=>"readonly"));
$this->html .= CHtml::textField('end',$end,array('placeholder'=>"ПО","class"=>"form-control",'readonly'=>"readonly"));
$this->html .= CHtml::submitButton('Найти',array("class"=>"btn btn-info"));
$this->html .= CHtml::endForm();
$this->html .= '</div>';
?>
<div class="row">
<div class="col-lg-12">
    <table class="table table-bordered">
        <tr>
            <th>Район</th>
            <th>Колличество заказов</th>
            <th>Оплата расклейщикам</th>
            <th>Прибыль с заказов</th>
            <th>Стоимость заказа (Общий показатель)</th>
        </tr>

        <? foreach($arr as $key => $value):?>
            <tr class="text-center">
                <td><?= $key ?></td>
                <td><?= $value['count'] ?></td>
                <td><?= $value['payment']?></td>
                <td><?= $value['profit']?></td>
                <td><?= round($value['overall'],2)?></td>
            </tr>
        <? endforeach ?>
    </table>
</div>
</div>