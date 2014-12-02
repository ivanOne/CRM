<? Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
<? Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/formhr.js'),
    CClientScript::POS_HEAD
);
$this->layout = "//layouts/column2";
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hrindex'),
    'Список табелей'=>array('hrtables'),
    'Расписание на месяц'
);
?>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <h3 class="text-center">Табель учета рабочего времени на <b><? echo $date ?></b></h3>
        </div>
    </div>
</div>

<div class="col-lg-12 tabe">
    <table class="table table-bordered tables">
        <thead>
        <tr>
            <td>
                ID
            </td>
            <td>
                ФИО
            </td>
            <td>
                Должность
            </td>
            <td>
                Телефон
            </td>
            <? $this->tableDraw($date)?>
        </tr>
        </thead>

        <?  foreach($list as $people){?>
            <tr id="<? echo $people->fio->id_user;?>" >
                <td><? echo $people->fio->id_user;?></td>
                <td><? echo $people->fio->fio;?></td>
                <td><? echo $people->idRole->name;?></td>
                <td><? echo $people->fio->telephone;?></td>
                <?$this->tableDrawPeople($people->fio->id_user,$date);?>
            </tr>
        <?} ?>
    </table>
</div>