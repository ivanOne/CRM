<?
$this->layout = "//layouts/column2";
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hrindex'),
    'Список табелей'
);
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
    'calendar','$("#HrReg_name").datetimepicker({
  format:"m-Y",
  lang:"ru",
  timepicker:false,

});',CClientScript::POS_READY
);

?>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-2 col-lg-offset-5">
            <h3 class="text-center">Список табелей</h3>
            <? echo CHtml::beginForm(array('hr/hrtables'),'post',array('id'=>'tableHr')); ?>
            <div class="form-group">
                <div class="centr">
                    <? echo CHtml::activeTextField($model,'name',array('size'=>15,'class'=>'form-control')); ?>
                    <? echo CHtml::error($model,'name');?>
                    <? echo CHtml::submitButton('Создать новый',array('class'=>'btn btn-danger form-control')) ?>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Имя</td>
                        <td></td>
                    </tr>
                </thead>
                <?
                    foreach($result as $item){
                ?>
                        <tr>
                            <td><a href="<? echo Yii::app()->createUrl('hr/hrmonth',array('name'=>$item->name)); ?>"><? echo $item->name;?></a></td>
                            <td class="text-center"><a href="<? echo Yii::app()->createUrl('hr/deleteTable',array('name'=>$item->name));?>"><i id="off" class="fa fa-times fa-1x"></i></a></td>
                        </tr>
                <?
                    }
                ?>
            </table>
            <?php $this->widget('CLinkPager', array(
                'pages' => $page,
                'header'=>'',
                'header'=>false,
                'htmlOptions'=>array('class'=>'pagination nolab'),
                'nextPageLabel'=>'>','lastPageLabel'=>'','prevPageLabel'=>'<','firstPageLabel'=>'',
                'selectedPageCssClass'=>'active',
            )) ?>
        </div>
    </div>
</div>