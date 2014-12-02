<?php
$this->menu=array(
    array('label'=>'Добавить платежи','url'=>Yii::app()->createUrl("advert/advertpostadd")),
    array('label'=>'Список платежей','url'=>Yii::app()->createUrl("advert/advertpostlist"))
);
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
Yii::app()->clientScript->registerScript(
    'todayReport','
        $("a.btn").each(function(){
            if (this.href == document.URL) {
			    $(this).addClass("active");
		}
        });
    ',CClientScript::POS_READY
);

?>
<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <th>Источник</th>
                <th>Колличество заказов</th>
                <th>Затраты</th>
                <th>Прибыль</th>
                <th>Рентабельность</th>
            </tr>
            <? foreach($result as $key=>$val): ?>
                <tr class="text-center">
                    <td><?= $key ?></td>
                    <td><?= $val['count']?></td>
                    <td><?= $val['pay']?></td>
                    <td><?= $val['profit']?></td>
                    <td><?= $val['rentability']?></td>
                </tr>
            <? endforeach ?>

        </table>
    </div>
</div>