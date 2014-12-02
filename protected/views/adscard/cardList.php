<?
$this->layout = "//layouts/column2";
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'=>array("ads/adsmenu"),
    'Список расклейщиков'
);
$this->menu=array(
    array('label'=>'Создать новую карточку', 'url'=>array('adscard/adscardcreate'))
);

?>

<div class="col-lg-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>ФИО</th>
                <th>Паспортные данные</th>
                <th>Проживание</th>
                <th>Телефон</th>
                <th>Дата рождения</th>
                <th>Дата начала работы</th>
            </tr>
            <?
            foreach($profiles as $li){
                echo "<tr>";
                echo "<td>".$li->id."</td>";
                echo "<td><a href=".Yii::app()->createUrl("adscard/adscardupdate",array('id'=>$li->id))."> ".$li->fio."</a></td>";
                echo "<td>".AdsProfile::getPas($li->passport)."</td>";
                echo "<td>".$li->propiska."</td>";
                echo "<td>".$li->telnum."</td>";
                echo "<td>".$li->dob."</td>";
                echo "<td>".$li->first_day."</td>";
                echo "</tr>";
            }
            ?>
        </thead>
    </table>
</div>