<?
$this->layout = "//layouts/column2";
$mo = AdsProfile::model()->findAll();
$this->html = "<h2 class='text-center'>Таблица привязки расклещиков к районам</h2>";
$list = CHtml::listData($mo,'id','fio');
Yii::app()->getClientScript()->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript(
'raz','
$("#z").click(function(){
    if($(this).attr("state") == "+"){
    $("td#hid,th#hid").show();
    $(this).attr("state","-");
}
else{
    $("td#hid,th#hid").css("display","none")
    $(this).attr("state","+")  ;
}
});
$(".pop").modal({show:false});
$(".can").click(function(){
    $(".pop").modal("hide");

});
',CClientScript::POS_READY
);
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'=>array("ads/adsmenu"),
    'Привязка расклейщиков к районам',
);
?>
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Район</th>
                        <th id="z" state="+">Расклейщик</th>
                        <th id="hid">Паспортные данные</th>
                        <th id="hid">Проживание</th>
                        <th id="hid">Телефон</th>
                        <th id="hid">Дата рождения</th>
                        <th id="hid">Дата начла в компании</th>
                        <th></th>
                    </tr>
                </thead>
                    <?
                    foreach($data as $dat){
                    ?>
                    <tr class="text-center">
                        <td><?= $dat->region0->name; ?></td>
                        <td ><?= $dat->ads0->fio?></td>
                        <td id="hid"><? UserProfiles::getPas($dat->ads0->passport)?></td>
                        <td id="hid"><?= $dat->ads0->propiska; ?></td>
                        <td id="hid"><?= $dat->ads0->telnum; ?></td>
                        <td id="hid"><?= $dat->ads0->dob; ?></td>
                        <td id="hid"><?= $dat->ads0->first_day; ?></td>
                        <td><span  class="links" data-toggle="modal" data-target=".tog<?= $dat->region0->id;?>">Сменить расклещика</span></td>
                    </tr>
                        <div role="dialog" class="modal fade bs-example-modal-sm pop tog<?= $dat->region0->id;?>">

                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="text-center">Информация по району <?=$dat->region0->name;?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Описание - <?= CHtml::encode($dat->region0->description);?></p>
                                        <p>Расклейщик: </p>
                                        <div class="form-group">
                                        <?= CHtml::beginForm(array("adsbase/baseupdate"));?>
                                        <?= CHtml::dropDownList('list',$dat->ads,$list,array("class"=>"form-control",'empty'=>"")); ?>
                                        </div>
                                        <div class="form-group">
                                        <?= CHtml::hiddenField("region",$dat->region);?>
                                        <?= CHtml::submitButton("Сохранить",array("class"=>"btn btn-primary form-control"));?>
                                        <?= CHtml::endForm(); ?>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-danger form-control can">Отмена</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?
                    }
                    ?>
            </table>
        </div>
    </div>
</div>