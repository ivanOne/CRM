<?php
$this->menu=array(
    array('label'=>'Добавить платежи','url'=>Yii::app()->createUrl("advert/advertpostadd")),
    array('label'=>'Отчет','url'=>Yii::app()->createUrl("advert/advertpost"))
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

$this->widgetClass = "search";
$this->html = CHtml::beginForm(Yii::app()->createUrl('advert/advertlist'),'get');
$this->html .= '<div class="form-inline">';
$this->html .= CHtml::textField('start',$start,array('placeholder'=>"С","class"=>"form-control",'readonly'=>"readonly"));
$this->html .= CHtml::textField('end',$end,array('placeholder'=>"ПО","class"=>"form-control",'readonly'=>"readonly"));
$this->html .= CHtml::submitButton('Найти',array("class"=>"btn btn-info"));
$this->html .= CHtml::endForm();
$this->html .= '</div>';
?>
<div class="row">
    <div class="col-lg-12 orders">
        <?
        $this->widget('ListView',array(
            'dataProvider'=>$data,
            'itemView'=>'_view',
            'ajaxUpdate' => false,
            'summaryText'=>"",
            'itemsTagName'=>'table',
            'itemsCssClass'=>'table table-bordered',
            'header'=>array('#','Дата','Источник','Стоимость',''),
            'pager'=>array('header'=>false,'htmlOptions'=>array('class'=>'pagination'),
                'nextPageLabel'=>'>','lastPageLabel'=>'>>','prevPageLabel'=>'<','firstPageLabel'=>'<<',
                'selectedPageCssClass'=>'active',
            ),
            'emptyText'=>'Ничего не найдено'


        ));
        ?>
</div>
</div>