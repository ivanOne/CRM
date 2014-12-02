<?
$this->layout = "//layouts/column2";
$this->html = '<div class="form-inline">';
$this->html .= CHtml::beginForm(Yii::app()->createUrl('adsarch/adsarchviews'),'get');
$this->html .= CHtml::textField('start',$start,array('placeholder'=>"С","class"=>"form-control"));
$this->html .= CHtml::textField('end',$end,array('placeholder'=>"ПО","class"=>"form-control"));
$this->html .= CHtml::submitButton('Найти',array("class"=>"btn btn-primary form-control"));
$this->html .= CHtml::endForm();
$this->html .= '</div>';

$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'=>array("ads/adsmenu"),
    'Журнал расклейки'=>array('adsarch/adsarchlist'),
    'Архив'
);
$this->menu=array(
    array('label'=>'Распределение заказов','url'=>Yii::app()->createUrl("adsarch/adsarchlist"))
);
$this->widget('ListView',array(
    'dataProvider'=>$data,
    'itemView'=>'_viewsa',
    'ajaxUpdate' => false,
    'summaryText'=>"",
    'itemsTagName'=>'table',
    'itemsCssClass'=>'table table-bordered',
    'header'=>array('#','Адрес','Дата заказа','Район','Расклейщик','Статус'),
    'pager'=>array('header'=>false,'htmlOptions'=>array('class'=>'pagination'),
        'nextPageLabel'=>'>','lastPageLabel'=>'>>','prevPageLabel'=>'<','firstPageLabel'=>'<<',
        'selectedPageCssClass'=>'active',
    ),
    'emptyText'=>'Ничего не найдено',
    'htmlOptions'=>array('id'=>'adsArch')

));
?>