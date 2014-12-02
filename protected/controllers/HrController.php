<?php

class HrController extends Controller{

    public function actionHrIndex(){
        $this->pageTitle = 'Меню менеджера HR';
        $this->render('index');
    }

    public function actionDeleteTable($name){
        $model = HrReg::model()->find('name=:name',array(':name'=>$name));
        if($model){
            $model->delete();
            $table = new TimeTable();
            $cond = new CDbCriteria();
            $days = date('t',strtotime("1-".$name));
            $dateW = date('Y-m-',strtotime("1-".$name));
            $cond->addBetweenCondition('dates',$dateW."1",$dateW.$days);
            $table->deleteAll($cond);
        }
        $this->redirect(array('hr/hrtables'));
    }

    public function actionHrTables(){
        $model = new HrReg();
        if(isset($_POST['HrReg'])){
            $model->attributes = $_POST['HrReg'];
            if($model->validate()){
                $model->save();
                $tab = new TimeTable();
                $tab->generatePeopleAll($_POST['HrReg']['name']);
                $this->redirect(array('hr/hrtables'));
            }
        }
        $criteria = new CDbCriteria();
        $count = HrReg::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->pageSize=10;
        $pager->applyLimit($criteria);
        $result = HrReg::model()->findAll($criteria);
        $this->render('hrReg',array('model'=>$model,'result'=>$result,'page'=>$pager));
    }

    public function actionHrMonth($name){
        $list = RolesUsers::model()->with('idRole','idUser','fio')->findAll('id_role>1');
        $this->render('monthForm',array('list'=>$list,'date'=>$name));
    }

    public function actionDay($time){
        $t = date("Y-m-d",strtotime($time));
        $arr = array();
        $li = TimeTable::model()->findAll('dates=:time',array(':time'=>$t));
        $i = 0;
        foreach($li as $l){
            $arr[$i]['obj'] = RolesUsers::model()->with('idRole','idUser','fio')->findAll('t.id_user ="'.$l->people.'"');
            $arr[$i]['state']=$l->status;
            $i++;
        }
        $this->render('todayForm',array('list'=>$arr,'time'=>$time));
    }

    public function tableDrawPeople($id,$monthYear){
        $status = array('0'=>"",'1'=>'Я','2'=>'ОТП','3'=>'ВЫХ');
        $table = "";
        $firstDay = date("Y-m-1",strtotime("1-".$monthYear));
        $lastDay =  date("Y-m-t",strtotime("1-".$monthYear));
        $days = date("t",strtotime("1-".$monthYear));
        $criteria = new CDbCriteria();
        $criteria->addCondition('people='.$id);
        $criteria->addBetweenCondition('dates',$firstDay,$lastDay);
        $obj = TimeTable::model()->findAll($criteria);
        $i=1;
        if($obj){
            foreach($obj as $item){
                if($i<15){
                    $table .= "<td id='".$id."' t='one'>".CHtml::dropDownList('status',$item->status,$status,array('id'=>$id,'date'=>$item->dates))."</td>";
                }
                if($i===15){
                    $table .= "<td id='".$id."' t='one'>".CHtml::dropDownList('status',$item->status,$status,array('id'=>$id,'date'=>$item->dates))."</td>";
                    $table .= "<td id='".$id."' t='itogOne'></td>";
                }
                if($i>15){
                    $table .= "<td id='".$id."' t='two'>".CHtml::dropDownList('status',$item->status,$status,array('id'=>$id,'date'=>$item->dates))."</td>";
                }
                if($i==$days){
                    $table .= "<td id='".$id."' t='itogTwo'></td>";
                    $table .= "<td id='".$id."' t='itogo'></td>";
                }
                $i++;
            }
        }
        else{
            $ob = new TimeTable();
            $ob->generatePeople($id,$monthYear);
            $this->tableDrawPeople($id,$monthYear);
        }
        echo $table;
    }

    public function tableDraw($monthYear){
        $days = date("t",strtotime("1-".$monthYear));
        $table = "";
        for($i=1;$i<=$days;$i++){
            $table .= "<td><a href=".Yii::app()->createUrl('hr/day',array('time'=>$i."-".$monthYear)).">".$i."-".$monthYear."</a></td>";
            if($i===15){
                $table .= "<td>Итог за пол месяца</td>";
            }
            if($i==$days){
                $table .= "<td>Итог за пол месяца</td>";
                $table .= "<td>Итог за месяц</td>";
            }
        }
        echo $table;
    }
}