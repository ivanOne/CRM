<?
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
    $("#start,#end").datetimepicker({
  format:"d.m.Y",
  lang:"ru",
  timepicker:false,
});
    $("#start").change(function(){
        $("#time").val("");
    })
',CClientScript::POS_READY
);
$this->layout = "//layouts/column2";
$this->menu=array(
    array('label'=>'Вернуться к списку', 'url'=>array('employee/employeelist')),

);
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Список сотрудников'=>array('employeelist'),
    'Профиль сотрудника'=>array('employeeprofile','id'=>$id),
    'Отчет по сотруднику'
);
$list = array("1"=>'Сегодня',"2"=>'Неделя',"3"=>'Месяц');
?>




    <?
    $this->widgetClass = "search";
    $this->html = CHtml::beginForm(array('employee/employeereport'),'get');
    $this->html .= '<div class="form-inline">';
    $this->html .= CHtml::dropDownList('time',$time,$list,array('empty'=>'','class'=>'form-control'));
    $this->html .= CHtml::textField('start',$start,array('placeholder'=>'C','class'=>'form-control'));
    $this->html .= CHtml::textField('end',$end,array('placeholder'=>'По','class'=>'form-control'));
    $this->html .= CHtml::hiddenField('name',$name);
    $this->html .= CHtml::hiddenField('id',$id);
    $this->html .= CHtml::submitButton('Поиск',array('class'=>'btn btn-info'));
    $this->html .= '</div>';
    $this->html .= CHtml::endForm();
    ?>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Чек</th>
                    <th>Чистая прибыль</th>
                    <th>Процент с заказа</th>
                </tr>
                <? $proc = Constant::model()->findByPk(1);
                   $itogTotal = 0;
                   $itogProfit = 0;
                   $itogProc = 0;
                   $sumPro = 0;
                   $failproc = (int)$fail*100/(int)$count;
                ?>

                <? foreach($orders as $order){ ?>
                    <?
                        $sumProc = ((int)$order->profit*(int)$proc->val)/100;
                        $itogTotal += (int)$order->total;
                        $itogProfit += (int)$order->profit;
                        $sumPro += $sumProc;
                    ?>
                    <tr>
                        <td><a href="<? echo Yii::app()->createUrl('orders/view',array('id'=>$order->id)); ?>"><? echo $order->id_abc;?></a></td>
                        <td id = "total" ><? echo $order->total; ?></td>
                        <td id = "profit"><? echo $order->profit; ?></td>
                        <td id = 'proc'><? echo $sumProc; ?></td>
                    </tr>
                <? } ?>
                <tr>
                    <th>Итог</th>
                    <th id = "itogTotal"><? echo $itogTotal; ?></th>
                    <th id = "itogProfit"><? echo $itogProfit; ?></th>
                    <th id = 'itogProc'><? echo $sumPro; ?></th>
                </tr>
                <tr>
                    <th>Отказы</th>
                    <th colspan="3"><? echo round($failproc,2) ?>%</th>
                </tr>
                <tr>
                    <th>Отработано дней</th>
                    <th colspan="3"><? echo $day ?></th>
                </tr>
                <tr>
                    <th>KPI</th>
                    <th colspan="3"><? echo $kpi ?></th>
                </tr>
            </thead>
        </table>