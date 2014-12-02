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
                    <th>Номер района</th>
                    <th>Колличество заказов</th>
                    <th>Чистая прибыль</th>
                    <th>Оплата расклейщикам</th>
                    <th>KPI</th>
                </tr>
                <?
                $itogTotal = 0;
                $itogProfit = 0;
                $itogPay = 0;
                ?>
                <?
                    foreach ($orders as $reg => $val) {
                        ?>
                        <tr>
                            <td><?= $reg ?></td>
                            <td id="total"><? echo $val['count'] ?></td>
                            <? $itogTotal += $val['count']; ?>
                            <td id="profit"><? echo $val['profit'] ?></td>
                            <? $itogProfit += $val['profit']; ?>
                            <td id='proc'><? echo $val['payment']; ?></td>
                            <? $itogPay += $val['payment']; ?>
                            <td id='proc'><? echo $val['kpi']; ?></td>
                        </tr>

                    <?}?>

                <tr>
                    <th>Итог</th>
                    <th id = "itogTotal"><? echo $itogTotal; ?></th>
                    <th id = "itogProfit"><? echo $itogProfit; ?></th>
                    <th id = 'itogProc'><? echo $itogPay; ?></th>
                </tr>
                </thead>
            </table>
