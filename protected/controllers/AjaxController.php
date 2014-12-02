<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 30.09.2014
 * Time: 12:47
 */

class AjaxController extends Controller {
    public function actionGettech(){
        $keyWord = $_GET['term'];
        $model = Technics::model()->findAll('name LIKE :name',array(':name'=>"%$keyWord%"));
        $arr = array();
        foreach($model as $mod){
            $arr[] = $mod->name;
        }
        $arr = json_encode($arr);
        echo $arr;
    }

    public function actionGetproblem(){
        $keyWord = $_GET['term'];
        $model = Orders::model()->findAll('problem LIKE :problem',array(':problem'=>"%$keyWord%"));
        $arr = array();
        foreach($model as $mod){
            $arr[] = $mod->problem;
        }
        $arr = json_encode($arr);
        echo $arr;
    }

    public function actionSetTimeStatus(){
        $crit = new CDbCriteria();
        $crit->condition = 'dates=:day and people=:id';
        $crit->params = array(':day'=>$_POST["date"],':id'=>$_POST['id']);
        $model = TimeTable::model()->find($crit);
        $model->status = $_POST['status'];
        $model->save();
    }

    public function actionAddChat(){
        if($_GET['people'] === Yii::app()->user->id){
            $date = date("Y-m-d H:i:s",time());
            $model = new OrdersChat();
            $model->text = $_GET['text'];
            $model->people = $_GET['people'];
            $model->date = $date;
            $model->order_id = $_GET['order'];
            if($model->validate()){
                $model->save();
            }
            else{
                echo "fgdf";
            }
        }
        elseif(isset($_GET['action'])){
            $arr = array();
            $models = OrdersChat::model()->findAll('order_id = :id',array(':id'=>$_GET['order']));
            foreach($models as $item){
                $arr[] = array('text'=>$item->text,'people'=>$item->pip->fio,'date'=>date("H:i:s d.m.Y",strtotime($item->date)));
            }
            $arrs = json_encode($arr);
            echo $arrs;

        }
        else{
            echo "Ай яй яй";
        }
    }
} 