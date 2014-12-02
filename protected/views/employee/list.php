<?
$this->layout = "//layouts/column2";
$list = array("4"=>"Инженеры","3"=>"Менеджеры","5"=>"HR");
Yii::app()->clientScript->registerScript(
    'cal','
    $("#role").change(function(){
        var val = $(this).val()
        window.location.href = "'.Yii::app()->createUrl('employee/employeelist').'&role="+val;
    });
    ',CClientScript::POS_READY
);
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Список сотрудников',

);
Yii::app()->clientScript->registerScript(
    'raz','
    $("#z").click(function(){
        if($(this).text() == "+"){
            $("td#hid,th#hid").show();
            $(this).text("-");
        }
        else{
            $("td#hid,th#hid").css("display","none");
            $(this).text("+");
        }

    });
    ',CClientScript::POS_READY
);
?>
            <? $this->html = "<div class='form-inline'>";?>
                <? $this->html .= CHtml::dropDownList('role',$li,$list); ?>
            <? $this->html .= "</div>";?>

    <div class="row">
        <div class="col-lg-12">
            <?
            if($li == 4 ){
                $this->renderPartial('listEngin',array('data'=>$data));
            }
            else{
                $this->renderPartial('listManage',array('data'=>$data));
            }
            ?>
        </div>
    </div>
    </div>

</div>