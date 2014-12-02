<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 14.11.2014
 * Time: 12:12
 */
class AdvertController extends Controller
{
    public function actionAdvertMenu(){
        $this->render('menu');
    }

    public function actionAdvertAds($time="",$start="",$end=""){
        $regions = AdsRegion::model()->findAll();
        $totalOrders = array();
        $resultAr = array();
        if ($time) {
            switch ($time) {
                case 1:
                    $today = date("Y-m-d", time());
                    foreach ($regions as $reg) {
                        $criteria = new CDbCriteria();
                        $criteria->with = "orders0";
                        $criteria->addCondition('t.date="' . $today . '"');
                        $criteria->addCondition('region=' . $reg->id);
                        $totalOrders[$reg->name] = AdsPay::model()->findAll($criteria);
                    }

                    foreach ($totalOrders as $key => $val) {
                        $resultAr[$key]["count"] = count($val);
                        foreach ($val as $ord) {
                            if($ord->pay == 1){
                                $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 350;
                            }
                            else{
                                $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 0;
                            }
                            $resultAr[$key]["profit"] += (int)$ord->orders0->profit;
                        }
                        $resultAr[$key]["overall"] = $resultAr[$key]["profit"]/($resultAr[$key]["payment"]+890);
                        if($resultAr[$key]['count'] == 0){
                            $resultAr[$key]['overall'] = 0;
                        }

                    }
                    break;
                case 2:
                    $weekStart = date('Y-m-d', strtotime(date('Y').'W'.date('W').'1'));
                    $weekEnd = date('Y-m-d', strtotime(date('Y').'W'.date('W').'7'));
                    foreach ($regions as $reg) {
                        $criteria = new CDbCriteria();
                        $criteria->addBetweenCondition('t.date',$weekStart,$weekEnd);
                        $criteria->addCondition('region=' . $reg->id);
                        $criteria->with = "orders0";
                        $totalOrders[$reg->name] = AdsPay::model()->findAll($criteria);
                    }

                    foreach ($totalOrders as $key => $val) {
                        $resultAr[$key]["count"] = count($val);
                        foreach ($val as $ord) {
                            if($ord->pay == 1){
                                $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 350;
                            }
                            else{
                                $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 0;
                            }
                            $resultAr[$key]["profit"] += (int)$ord->orders0->profit;
                        }
                        $resultAr[$key]["overall"] = $resultAr[$key]["profit"]/($resultAr[$key]["payment"]+(890*7));
                        if($resultAr[$key]['count'] == 0){
                            $resultAr[$key]['overall'] = 0;
                        }

                    }


                case 3:
                    $firstDay = date("Y-m-1");
                    $lastDay =  date("Y-m-t");
                    $days = date("t");
                    foreach ($regions as $reg) {
                        $criteria = new CDbCriteria();
                        $criteria->addBetweenCondition('t.date',$firstDay,$lastDay);
                        $criteria->addCondition('region=' . $reg->id);
                        $criteria->with = "orders0";
                        $totalOrders[$reg->name] = AdsPay::model()->findAll($criteria);
                    }

                    foreach ($totalOrders as $key => $val) {
                        $resultAr[$key]["count"] = count($val);
                        foreach ($val as $ord) {
                            if($ord->pay == 1){
                                $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 350;
                            }
                            else{
                                $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 0;
                            }
                            $resultAr[$key]["profit"] += (int)$ord->orders0->profit;
                        }
                        $resultAr[$key]["overall"] = $resultAr[$key]["profit"]/($resultAr[$key]["payment"]+890*(int)$days);
                        if($resultAr[$key]['count'] == 0){
                            $resultAr[$key]['overall'] = 0;
                        }

                    }
                    break;
                case 4:
                    $today = date("Y-m-d", strtotime("-1 day"));
                    foreach ($regions as $reg) {
                        $criteria = new CDbCriteria();
                        $criteria->with = "orders0";
                        $criteria->addCondition('t.date="' . $today . '"');
                        $criteria->addCondition('region=' . $reg->id);
                        $totalOrders[$reg->name] = AdsPay::model()->findAll($criteria);
                    }

                    foreach ($totalOrders as $key => $val) {
                        $resultAr[$key]["count"] = count($val);
                        foreach ($val as $ord) {
                            if($ord->pay == 1){
                                $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 350;
                            }
                            else{
                                $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 0;
                            }
                            $resultAr[$key]["profit"] += (int)$ord->orders0->profit;
                        }
                        $resultAr[$key]["overall"] = $resultAr[$key]["profit"]/($resultAr[$key]["payment"]+890);
                        if($resultAr[$key]['count'] == 0){
                            $resultAr[$key]['overall'] = 0;
                        }

                    }
                    break;

            }
        }
        elseif($start and $end){
            $start = strtotime($start);
            $end = strtotime($end);
            $startPeriod = date("Y-m-d",$start." 00:00:00");
            $endPeriod = date("Y-m-d",$end." 23:59:59");
            $toPubStart = date("d-m-Y",strtotime($startPeriod));
            $toPubEnd = date("d-m-Y",strtotime($endPeriod));
            $datetime1 = date_create($startPeriod);
            $datetime2 = date_create($endPeriod);
            $interval = date_diff($datetime1, $datetime2);
            $days = $interval->days;
            foreach ($regions as $reg) {
                $criteria = new CDbCriteria();
                $criteria->addBetweenCondition('t.date',$startPeriod,$endPeriod);
                $criteria->addCondition('region=' . $reg->id);
                $criteria->with = "orders0";
                $totalOrders[$reg->name] = AdsPay::model()->findAll($criteria);
            }

            foreach ($totalOrders as $key => $val) {
                $resultAr[$key]["count"] = count($val);
                foreach ($val as $ord) {
                    if($ord->pay == 1){
                        $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 350;
                    }
                    else{
                        $resultAr[$key]["payment"] = (int)$resultAr[$key]["payment"] += 0;
                    }
                    $resultAr[$key]["profit"] += (int)$ord->orders0->profit;
                }
                $resultAr[$key]["overall"] = $resultAr[$key]["profit"]/($resultAr[$key]["payment"]+890*(int)$days);
                if($resultAr[$key]['count'] == 0){
                    $resultAr[$key]['overall'] = 0;
                }

            }

        }
        else{
            foreach ($regions as $reg) {
                $resultAr[$reg->name]["count"] = 0;
                $resultAr[$reg->name]["profit"] = 0;
                $resultAr[$reg->name]["payment"] = 0;
                $resultAr[$reg->name]["overall"] = 0;
            }

        }

        $this->render('ads',array('arr' => $resultAr,'start'=>$toPubStart,'end'=>$toPubEnd));
    }

    public function actionAdvertSite(){
        $ch = curl_init();
        $mass = array("method"=>"GetSummaryStat",'param'=>array('CampaignIDS'=>array(10233244),'StartDate'=>"2014-11-24",'EndStart'=>"2014-11-28","token"=>"ad74a6ab867b4613a10e8d3abd65547a"),'locale'=>'ru');
        //var_dump(json_encode($mass));
        curl_setopt($ch, CURLOPT_URL,"https://api.direct.yandex.ru/v4/json/");
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($mass));
        $dd = curl_exec($ch);
        $info = curl_getinfo($ch);
        var_dump($dd);
       var_dump($info);
    }

    public function actionAdvertPost($month="11",$year="2014"){
        if($month and $year){
            $time = "01-".$month."-".$year;
            $firstDay = date("Y-m-1",strtotime($time));
            $lastDay =  date("Y-m-t",strtotime($time));

        }
        else{
            $firstDay = date("Y-m-1");
            $lastDay =  date("Y-m-t");
        }
        $sources = Source::model()->findAll('type="post" and status=1');
        $resultAr = array();
        foreach($sources as $source){
            $criteriaOrders = new CDbCriteria();
            $criteriaPayment = new CDbCriteria();
            $criteriaOrders->addBetweenCondition('date',$firstDay." 00:00:00",$lastDay." 23:59:59");
            $criteriaPayment->addBetweenCondition('date',$firstDay,$lastDay);
            $criteriaOrders->addCondition('status=3 and source='.$source->id.'');
            $criteriaPayment->addCondition('id_post='.$source->id.'');
            $orders = Orders::model()->findAll($criteriaOrders);
            $payment = AdvertPostCoast::model()->findAll($criteriaPayment);
            $resultAr[$source->name]['count'] = count($orders);
            foreach($orders as $order){
                $resultAr[$source->name]['profit'] += (int)$order->profit;
            }
            foreach($payment as $pay){
                $resultAr[$source->name]['pay'] += (int)$pay->coast;
            }
            $resultAr[$source->name]['rentability'] = $resultAr[$source->name]['profit']/$resultAr[$source->name]['pay']*100;
        }
        $this->render('post',array('result'=>$resultAr));
    }

    public function actionAdvertPostAdd(){
        if(isset($_POST['pay'])){
            $postPay = new AdvertPostCoast();
            $_POST['pay']['date'] = date("Y-m-d",strtotime($_POST['pay']['date']));
            $postPay->attributes = $_POST['pay'];
            if($postPay->validate()){
                $postPay->save();
            }
        }
        $this->render('postpayform');
    }

    public function actionAdvertPostList($start = "",$end = ""){
        $criteria = new CDbCriteria();
        if($start and $end){
            $criteria->addBetweenCondition("date",date("Y-m-d",strtotime($start)),date("Y-m-d",strtotime($end)));
        }
        $criteria->with=array('idPost');
        $data = new CActiveDataProvider('AdvertPostCoast',array(
            'criteria'=>$criteria
        ));
        $this->render('list',array('data'=>$data));
    }

    public function actionAdvertPostDel($id){
        AdvertPostCoast::model()->deleteByPk($id);
        $this->redirect(array("advert/advertpostlist"));
    }
}