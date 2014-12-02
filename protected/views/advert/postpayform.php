<? $data = Source::model()->findAll("type = 'post' and status = 1");
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
    $("#date").datetimepicker({
        format:"d-m-Y",
        lang:"ru",
        timepicker:false});
    ',CClientScript::POS_READY
);
$this->layout = "//layouts/column2";
$this->pageTitle = "Отчет по расклейке";
$this->breadcrumbs=array(
    'Заказы'=>array('orders/index'),
    'Ежедневный отчет'
);
$this->menu=array(
    array('label'=>'Отчет','url'=>Yii::app()->createUrl("advert/advertpost")),
    array('label'=>'Список платежей','url'=>Yii::app()->createUrl("advert/advertpostlist"))
);
?>
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <form action="" method="post">
            <div class="form-group">
                <label for="date">Дата</label>
                <input type="text" class="form-control" id="date" name="pay[date]" readonly/>
            </div>
            <div class="form-group">
                <label for="source">Источник</label>
                <select class="form-control" name="pay[id_post]">
                    <option value=""></option>
                    <? foreach($data as $source):?>
                        <option value="<?= $source->id?>"><?= $source->name?></option>
                    <? endforeach?>
                </select>
            </div>
            <div class="form-group">
                <label for="summ">Сумма</label>
                <input class="form-control" name="pay[coast]" type="text" />
            </div>
            <div class="form-group">
                <input class="btn btn-danger form-control" type="submit" value="Записать"/>
            </div>
        </form>
    </div>
</div>