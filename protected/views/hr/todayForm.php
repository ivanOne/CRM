<? Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
<? Yii::app()->clientScript->registerScriptFile(
    CHtml::asset(Yii::app()->request->baseUrl.'js/formhrday.js'),
    CClientScript::POS_HEAD
);
$this->layout = "//layouts/column2";
$status = array('0'=>"",'1'=>'Я','2'=>'ОТП','3'=>'ВЫХ');
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hrindex'),
    'Список табелей'=>array('hrtables'),
    'Расписание на месяц'=>array('hrmonth'),
    "Расписание на день"
);
?>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <h3 class="text-center">Табель учета рабочего времени на <b><? echo $time ?></b></h3>
        </div>
    </div>
</div>

<div class="col-lg-12">
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
            <td class="text-center">
                <? echo $time;?>
            </td>
        </tr>
        </thead>

        <?  foreach($list as $people){
            $id = 0;
                echo "<tr>";
                foreach($people['obj'] as $pip){
                    echo "<td>".$pip->fio->id_user."</td>";
                    echo "<td>".$pip->fio->fio."</td>";
                    echo "<td>".$pip->idRole->name."</td>";
                    echo "<td>".$pip->fio->telephone."</td>";
                    $id = $pip->fio->id_user;
                }
                echo "<td>".CHtml::dropDownList('status',$people['state'],$status,array('class'=>'form-control',
                        'id'=>$id,'date'=>date('Y-m-d',strtotime($time))))."</td>";
                echo "</tr>";
        } ?>
    </table>
</div>