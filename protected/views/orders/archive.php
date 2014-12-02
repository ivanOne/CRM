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
$this->pageTitle = "Архив";
$this->breadcrumbs=array(
    'Архив',
);
$list = array('Сегодня','Вчера','Неделя','Месяц');
$status = CHtml::listData(Status::model()->findAll(),'id','name');
unset($status[1]);
unset($status[2]);
$this->menu=array(
    array('label'=>'Создать заказ', 'url'=>array('CreateOrder')),
    array('label'=>'Заказы', 'url'=>array('index'))
);?>
<?
$this->widgetClass = "search";
$this->html = CHtml::beginForm(Yii::app()->createUrl('orders/archiveorder'),'get');
$this->html .= '<div class="form-inline">';
    $this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/archiveorder",array("date" => '0')).'">Сегодня</a>';
    $this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/archiveorder",array("date" => '1')).'">Вчера</a>';
    $this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/archiveorder",array("date" => '2')).'">Неделя</a>';
    $this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/archiveorder",array("date" => '3')).'">Месяц</a>';
    $this->html .= '<span class="mintab">';
    $this->html .= CHtml::dropDownList('status',$stat,$status,array('empty'=>'','class'=>'form-control'));
    $this->html .= CHtml::textField('num',$num,array('placeholder'=>'Дата для поиска','class'=>'form-control'));
    $this->html .= CHtml::textField('numsearch',$numsearch,array('placeholder'=>'Номер заказа','class'=>'form-control'));
    $this->html .= CHtml::textField('telnum',$telnumnum,array('placeholder'=>'Номер телефона','class'=>'form-control'));
    $this->html .= CHtml::submitButton('Поиск',array('class'=>'btn btn-info'));
    $this->html .= "</span>";
    $this->html .= '</div>';
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