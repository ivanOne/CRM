<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 12.11.2014
 * Time: 11:37
 */

class TimeWidget extends CWidget {

    public function init(){
        Yii::app()->getClientScript()->registerCoreScript('jquery');
        Yii::app()->clientScript->registerCssFile(
            CHtml::asset(Yii::getPathOfAlias('application.components.Time')."/css/timeTo.css")
        );
        Yii::app()->clientScript->registerScriptFile(
            CHtml::asset(Yii::getPathOfAlias('application.components.Time')."/js/jquery.timeTo.min.js"),
            CClientScript::POS_HEAD
        );
        Yii::app()->clientScript->registerScript(
            'widgetClock','
            $("#widgetClock").timeTo({fontSize: 25});
    ',CClientScript::POS_READY
        );
        $massDate = array('1'=>"Января",'2'=>'Февраля','3'=>'Марта','4'=>'Апреля','5'=>'Мая','6'=>"Июня",'7'=>'Июля','8'=>"Августа",
        "9"=>'Сентября',"10"=>"Октября","11"=>"Ноября","12"=>"Декабря");
        $massWed = array('1'=>'Понедельник','2'=>'Вторник','3'=>'Среда','4'=>'Четверг','5'=>"Пятница",'6'=>'Суббота',
            '7'=>'Пятнцица');
        $time = time();
        $wedDay = date('N',$time);
        $day = date("d",$time);
        $month = date("n",$time);
        $year = date("Y",$time);
        $str = $massWed[$wedDay]." ".$day." ".$massDate[$month]." ".$year.".г";
        $now = date("Y-m-d",$time);
        $list = TimeTable::model()->with(array('people0','roles0'=>array(
            'condition'=>'id_role = 4 or id_role = 3'
        )))->findAll('dates = "'.$now.'" and  status = 1');
        $nameMan = array();
        $nameEng = array();
        foreach($list as $li){
            if($li->roles0->id_role == "4"){
                $nameEng[$li->people0->fio] = $li->people0->telephone;
            }
            else{
                $nameMan[$li->people0->fio] = $li->people0->telephone;
            }

        }
        $this->renderFile(Yii::getPathOfAlias('application.components.Time.clock'),array('date'=>$str,'manList'=>$nameMan,'engList'=>$nameEng));
    }
} 