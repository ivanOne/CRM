<?php
$this->layout = "//layouts/column2";
$this->pageTitle = "Ежедневный отчет";
$this->breadcrumbs=array(
    'Заказы'=>array('orders/index'),
    'Ежедневный отчет'
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
    $this->html = CHtml::beginForm(Yii::app()->createUrl('orders/archiveorder'),'get');
    $this->html .= '<div class="form-inline">';
    $this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/todayreport",array('time' => '1')).'">
                Сегодня
            </a>';
    $this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/todayreport",array('time' => '2')).'">
                Вчера
            </a>';
    $this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/todayreport",array('time' => '3')).'">
                Неделя
            </a>';
    $this->html .= '<a class="btn btn-info" href="'.Yii::app()->createUrl("orders/todayreport",array('time' => '4')).'">
                Месяц
            </a>';
$this->html .= '</div>';
?>


            <? $this->renderPartial($view,array('data'=>$data))?>

