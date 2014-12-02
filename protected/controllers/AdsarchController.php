<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 30.10.2014
 * Time: 19:42
 */

class AdsarchController extends Controller {

    public function actionAdsArchList($start = null, $end = null){
        $criteria = new CDbCriteria();
        if(!(is_null($start)and is_null($end))){
            $startb = date("Y-m-d",strtotime($start));
            $endb = date("Y-m-d",strtotime($end));
            $criteria->addBetweenCondition('t.date',$startb." 00:00:00",$endb." 23:59:59");
        }
        $criteria->addCondition("source=6");
        $criteria->addCondition("status=3");
        $criteria->with = array('fio','ads'=>array(
            'joinType'=>'LEFT OUTER JOIN',
            'condition'=>'ads.id is null'
            ));
        $data = new CActiveDataProvider("Orders",array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $this->render('list',array('data'=>$data,'start'=>$start,'end'=>$end));
    }

    public function actionAdsGetinfo(){
        $region = $_GET['region'];
        $fio = AdsAndRegion::model()->with('ads0')->find('region=:reg',array(':reg'=>$region));
        if($fio){
            echo $fio->ads0->fio;
        }
        else{
            echo false;
        }
    }

    public function actionAdsToArch(){
        $model = new AdsPay();
        $model->id = trim($_GET["id"]);
        $model->id_abc = trim($_GET["id_abc"]);
        $model->addr = trim($_GET["addr"]);
        $model->date = date("Y-m-d",strtotime(trim($_GET["date"])));
        $model->region = trim($_GET["region"]);
        if($_GET["pay"] == 1){
            $model->ads = trim($_GET["adsman"]);
        }
        else{
            $model->ads = null;
        }
        $model->pay = trim($_GET['pay']);
        $model->save();
    }

    public function actionAdsOfArch(){
        $id = $_GET['id'];
        $model = AdsPay::model()->findByPk($id);
        $resAr = array();
        $resAr['id'] = $model->id;
        $resAr['id_abc'] = $model->id_abc;
        $resAr['region'] = $model->region;
        $resAr['addr'] = $model->addr;
        $resAr['date'] = date("d-m-Y",strtotime($model->date));
        $resAr['ads'] = $model->ads;
        $resAr['pay'] = $model->pay;
        echo json_encode($resAr);
        AdsPay::model()->deleteByPk($model->id);
    }

    public function actionAdsArchViews($start = null,$end = null){
        $criteria = new CDbCriteria();
        if(!(is_null($start)and is_null($end))){
            $startb = date("Y-m-d",strtotime($start));
            $endb = date("Y-m-d",strtotime($end));
            $criteria->addBetweenCondition('date',$startb." 00:00:00",$endb." 23:59:59");
        }

        $criteria->with = "region0";
        $data = new CActiveDataProvider('AdsPay',array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $this->render("archive",array('data' => $data,'start'=>$start,'end'=>$end));
    }

} 