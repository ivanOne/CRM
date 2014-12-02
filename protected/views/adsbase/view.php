<?
$this->layout = "//layouts/column2";
Yii::app()->clientScript->registerScriptFile(
CHtml::asset(Yii::app()->request->baseUrl.'js/jquery.maskedinput.min.js'),
CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScript(
'mask','
$(".inp").mask("99:99");
',CClientScript::POS_READY
);
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'=>array("ads/adsmenu"),
    'Отчет'
);
?>
<div class="col-lg-offset-1 col-lg-10">
    <h3 class="text-center">Отчет за <?= date("d.m.Y",strtotime($date));?></h3>
    <?= CHtml::beginForm(array('adsbase/dailyreportupdate'));?>
    <?= CHtml::hiddenField('date',$date);?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Район</th>
                <th>Расклейщик</th>
                <th>Начало расклейки</th>
                <th>Конец расклейки</th>
                <th>Колличество объявлений</th>
            </tr>
        </thead>

            <? foreach($grid as $item){
                ?>
                <tr class="text-center">
                      <td><?= $item->region;?></td>
                      <td><?= $item->ads; ?></td>
                    <?if($item->ads){?>
                      <td><?= CHtml::textField('quantity['.$item->id.'][start]',date("H:i",strtotime($item->date_report." ".$item->start)),array('class'=>'form-control text-center inp'));?></td>
                      <td><?= CHtml::textField('quantity['.$item->id.'][end]',date("H:i",strtotime($item->date_report." ".$item->end)),array('class'=>'form-control text-center inp'));?></td>
                      <td><?= CHtml::textField('quantity['.$item->id.'][quantity]',$item->quantity,array('class'=>'form-control text-center')); ?></td>
                    <? }
                    else{?>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?}?>
                </tr>
            <?}?>


    </table>
    <?= CHtml::submitButton("Сохранить",array('class' => 'btn btn-primary'));?>
    <a href="<?= Yii::app()->createUrl("adsbase/dailyreportlist");?>" class="btn btn-danger">Отмена</a>
    <?= CHtml::endForm();?>
</div>