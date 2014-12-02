<?
$this->layout = "//layouts/column2";
$this->menu=array(
    array('label'=>'Создать новый район', 'url'=>array('adsregion/regioncreate'))
);
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'=>array("ads/adsmenu"),
    'Список районов',
);
?>

<div class="col-lg-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Название</th>
                <th>Описание</th>
            </tr>
            <?
            foreach($model as $li){
                echo "<tr>";
                echo "<td><a href=".Yii::app()->createUrl("adsregion/regionupdate",array('id'=>$li->id))."> ".$li->name."</a></td>";
                echo "<td>".$li->description."</td>";
                echo "</tr>";
            }
            ?>
        </thead>
    </table>
</div>