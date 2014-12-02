<?php

Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/font-awesome.min.css')
);
Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/jquery.datetimepicker.css')
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery.datetimepicker.js'),
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/jquery.mobile.custom.min.js'),
    CClientScript::POS_HEAD
);

Yii::app()->clientScript->registerScript(
    'orders','
    var ids;
    $("#num").datetimepicker({
  format:"Y-m-d",
  lang:"ru",
  timepicker:false,
});
    $(".pager").removeAttr("class");
    $(".orders tbody tr").on( "click", function(){(
        (ids = ($(this).attr("id")))
        (window.location.href = "'.Yii::app()->createUrl('orders/view').'&id="+ids)
    )});
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

$this->layout = "//layouts/column2";
$this->pageTitle = "Заказы";
$this->breadcrumbs=array(
    'Заказы',
);
$list = array('Сегодня','Вчера','Неделя','Месяц');
$status = CHtml::listData(Status::model()->findAll(),'id','name');
unset($status[3]);
unset($status[4]);
$this->menu=array(
    array('label'=>'Создать заказ', 'url'=>array('CreateOrder'),'visible'=>!Yii::app()->user->checkAccess('4')),
    array('label'=>'Архив', 'url'=>array('ArchiveOrder'),'visible'=>!Yii::app()->user->checkAccess('4')),
    array('label'=>'Ежедневный отчет', 'url'=>array('todayreport','time'=>'1'))
);
$this->widgetClass = "search";
$this->html = CHtml::beginForm(Yii::app()->createUrl('orders/index'),'get');
$this->html .= '<div class="form-inline">';
$this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/index",array("date" => '1')).'">Сегодня</a>';
$this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/index",array("date" => '2')).'">Вчера</a>';
$this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/index",array("date" => '3')).'">Неделя</a>';
$this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/index",array("date" => '4')).'">Месяц</a>';
$this->html .= '<span class="mintab">';
$this->html .= CHtml::dropDownList('status',$stat,$status,array('empty'=>'','class'=>'form-control'));
$this->html .= CHtml::textField('num',$num,array('placeholder'=>'Дата для поиска','class'=>'form-control'));
$this->html .= CHtml::textField('numsearch',$numsearch,array('placeholder'=>'Номер заказа','class'=>'form-control'));
$this->html .= CHtml::textField('telnum',$telnumnum,array('placeholder'=>'Номеру телефона','class'=>'form-control'));
$this->html .= CHtml::submitButton('Поиск',array('class'=>'btn btn-info'));
$this->html .= '</span>';
$this->html .= "</div>";
$this->html .= CHtml::endForm();

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
            'header'=>array('#','Статус','Дата заказа','Заказчик','Техника','Проблема','Номер телефона','Адрес','Курьер',
                'Инженер','Менеджер','Время выезда'),
            'pager'=>array('header'=>false,'htmlOptions'=>array('class'=>'pagination'),
                'nextPageLabel'=>'>','lastPageLabel'=>'>>','prevPageLabel'=>'<','firstPageLabel'=>'<<',
                'selectedPageCssClass'=>'active',
                ),
            'emptyText'=>'Ничего не найдено'


        ));
        ?>
</div>
</div>