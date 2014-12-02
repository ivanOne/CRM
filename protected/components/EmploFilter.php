<?php

class EmploFilter{

    public function emploReportFilter($id,$time="",$start,$end,$row)
    {
        $criteria = new CDbCriteria();
        $kpiCriteria = new CDbCriteria();
        if ($time){
            switch($time){
                case 1:
                    $today = date("Y-m-d", time());
                    $yesterday = date("Y-m-d", strtotime("-1 day"));
                    $criteria->select = array('total', 'profit', 'id_abc','status','id');
                    $criteria->params = array(":id" => $id);
                    $criteria->addCondition($row.'=:id and (status=3 or status=4)');
                    $criteria->addCondition('time_close="'.$today.'"');
                    $totalOrders = Orders::model()->count($criteria);
                    $orderList = Orders::model()->findAll($criteria);
                    $kpiCriteria->select = 'profit';
                    $kpiCriteria->params = array(":id" => $id);
                    $kpiCriteria->addCondition($row.'=:id and status=3');
                    $kpiCriteria->addCondition('time_close="'.$yesterday.'"');
                    $kpiPofit = Orders::model()->findAll($kpiCriteria);
                    $lastProfit = 0;
                    foreach($kpiPofit as $profit){
                        $lastProfit += (int)$profit->profit;
                    }
                    $curentProfit = 0;
                    $fail = 0;
                    $li = array();
                    foreach ($orderList as $list) {
                        if($list->status == 4) {
                            $fail++;
                        }
                        else{
                            $li[] = $list;
                        }
                        $curentProfit += (int)$list->profit;
                    }
                    $kpi = ($curentProfit/$lastProfit)*100;
                    $kpi = round($kpi,2);
                    $day = TimeTable::model()->count('people ='.$id.' and dates='.$today.' and status=1');
                    $result['count'] = $totalOrders;
                    $result['list'] = $li;
                    $result['fail'] = $fail;
                    $result['kpi'] = $kpi;
                    $result['day'] = $day;
                    return $result;
                case 2:
                    $weekStart = date('Y-m-d', strtotime(date('Y').'W'.date('W').'1'));
                    $weekEnd = date('Y-m-d', strtotime(date('Y').'W'.date('W').'7'));
                    $weekLastEnd = date("Y-m-d",(strtotime(date('Y').'W'.date('W').'1'))-86400);
                    $weekLastStart = date("Y-m-d",(strtotime(date('Y').'W'.date('W').'1'))-604800);
                    $criteria->select = array('total', 'profit', 'id_abc','status','id');
                    $criteria->params = array(":id" => $id);
                    $criteria->addCondition($row.'=:id and (status=3 or status=4)');
                    $criteria->addBetweenCondition('time_close',$weekStart,$weekEnd);
                    $totalOrders = Orders::model()->count($criteria);
                    $orderList = Orders::model()->findAll($criteria);
                    $kpiCriteria->select = 'profit';
                    $kpiCriteria->params = array(":id" => $id);
                    $kpiCriteria->addCondition($row.'=:id and status=3');
                    $kpiCriteria->addBetweenCondition('time_close',$weekLastStart,$weekLastEnd);
                    $kpiPofit = Orders::model()->findAll($kpiCriteria);
                    $lastProfit = 0;
                    foreach($kpiPofit as $profit){
                        $lastProfit += (int)$profit->profit;
                    }
                    $curentProfit = 0;
                    $fail = 0;
                    $li = array();
                    foreach ($orderList as $list) {
                        if($list->status == 4) {
                            $fail++;
                        }
                        else{
                            $li[] = $list;
                        }
                        $curentProfit += (int)$list->profit;
                    }
                    $kpi = ($curentProfit/$lastProfit)*100;
                    $kpi = round($kpi,2);
                    $count = new CDbCriteria();
                    $count->addCondition('people ='.$id.'  and status=1');
                    $count->addBetweenCondition('dates',$weekStart,$weekEnd);
                    $day = TimeTable::model()->count($count);
                    $result['count'] = $totalOrders;
                    $result['list'] = $li;
                    $result['fail'] = $fail;
                    $result['kpi'] = $kpi;
                    $result['day'] = $day;
                    return $result;

                case 3:
                    $firstDay = date("Y-m-1");
                    $lastDay =  date("Y-m-t");
                    $firstDayLast = date("Y-m-1",strtotime('-1 month'));
                    $lastDayLast =  date("Y-m-t",strtotime('-1 month'));
                    $criteria->select = array('total', 'profit', 'id_abc','status','id');
                    $criteria->params = array(":id" => $id);
                    $criteria->addCondition($row.'=:id and (status=3 or status=4)');
                    $criteria->addBetweenCondition('time_close',$firstDay,$lastDay);
                    $totalOrders = Orders::model()->count($criteria);
                    $orderList = Orders::model()->findAll($criteria);
                    $kpiCriteria->select = 'profit';
                    $kpiCriteria->params = array(":id" => $id);
                    $kpiCriteria->addCondition($row.'=:id and status=3');
                    $kpiCriteria->addBetweenCondition('time_close',$firstDayLast,$lastDayLast);
                    $kpiPofit = Orders::model()->findAll($kpiCriteria);
                    $lastProfit = 0;
                    foreach($kpiPofit as $profit){
                        $lastProfit += (int)$profit->profit;
                    }
                    $curentProfit = 0;
                    $fail = 0;
                    $li = array();
                    foreach ($orderList as $list) {
                        if($list->status == 4) {
                            $fail++;
                        }
                        else{
                            $li[] = $list;
                        }
                        $curentProfit += (int)$list->profit;
                    }
                    $kpi = ($curentProfit/$lastProfit)*100;
                    $kpi = round($kpi,2);
                    $count = new CDbCriteria();
                    $count->addCondition('people ='.$id.'  and status=1');
                    $count->addBetweenCondition('dates',$firstDay,$lastDay);
                    $day = TimeTable::model()->count($count);
                    $result['count'] = $totalOrders;
                    $result['list'] = $li;
                    $result['fail'] = $fail;
                    $result['kpi'] = $kpi;
                    $result['day'] = $day;
                    return $result;
            }
        }
        elseif($start and $end){
            $start = strtotime($start);
            $end = strtotime($end);
            $startPeriod = date("Y-m-d",$start);
            $endPeriod = date("Y-m-d",$end);
            $y = $end - $start;
            $endLast = $start - 86400;
            $startLast = $endLast - $y;
            $startLastPeriod = date("Y-m-d",$endLast);
            $endLastPeriod = date("Y-m-d",$startLast);
            $criteria->select = array('total', 'profit', 'id_abc','status','id');
            $criteria->params = array(":id" => $id);
            $criteria->addCondition($row.'=:id and (status=3 or status=4)');
            $criteria->addBetweenCondition('time_close',$startPeriod,$endPeriod);
            $totalOrders = Orders::model()->count($criteria);
            $orderList = Orders::model()->findAll($criteria);
            $kpiCriteria->select = 'profit';
            $kpiCriteria->params = array(":id" => $id);
            $kpiCriteria->addCondition($row.'=:id and status=3');
            $kpiCriteria->addBetweenCondition('time_close',$startLastPeriod,$endLastPeriod);
            $kpiPofit = Orders::model()->findAll($kpiCriteria);
            $lastProfit = 0;
            foreach($kpiPofit as $profit){
                $lastProfit += (int)$profit->profit;
            }
            $curentProfit = 0;
            $fail = 0;
            $li = array();
            foreach ($orderList as $list) {
                if($list->status == 4) {
                    $fail++;
                }
                else{
                    $li[] = $list;
                }
                $curentProfit += (int)$list->profit;
            }
            $kpi = ($curentProfit/$lastProfit)*100;
            $kpi = round($kpi,2);
            $count = new CDbCriteria();
            $count->addCondition('people ='.$id.'  and status=1');
            $count->addBetweenCondition('dates',$startPeriod,$endPeriod);
            $day = TimeTable::model()->count($count);
            $result['count'] = $totalOrders;
            $result['list'] = $li;
            $result['fail'] = $fail;
            $result['kpi'] = $kpi;
            $result['day'] = $day;
            return $result;
        }
        else{
            $result['count'] = 0;
            $result['list'] = 0;
            $result['fail'] = 0;
            $result['kpi'] = 0;
            $result['day'] = 0;
            return $result;
        }
    }

    public function HrReportFilter($time="",$start,$end)
    {
        $regions = AdsRegion::model()->findAll();
        $totalOrders = array();
        $kpiTotalOrders = array();
        $resultAr = array();
        if ($time) {
            switch ($time) {
                case 1:
                    $today = date("Y-m-d", time());
                    $yesterday = date("Y-m-d", strtotime("-1 day"));
                    foreach ($regions as $reg) {
                        $criteria = new CDbCriteria();
                        $kpiCriteria = new CDbCriteria();
                        $criteria->addCondition('t.date="' . $today . '"');
                        $kpiCriteria->addCondition('t.date="' . $yesterday . '"');
                        $criteria->addCondition('region=' . $reg->id);
                        $criteria->with = "orders0";
                        $kpiCriteria->addCondition('region=' . $reg->id);
                        $kpiCriteria->with = "orders0";
                        $totalOrders[$reg->name] = AdsPay::model()->findAll($criteria);
                        $kpiTotalOrders[$reg->name] = AdsPay::model()->findAll($kpiCriteria);
                    }
                    foreach ($totalOrders as $key => $val) {

                        $kpi = 0;
                        $resultAr[$key]["count"] = count($val);
                        foreach ($val as $ord) {
                            $prof = (int)$ord->orders0->profit;
                            $resultAr[$key]["profit"] += $prof;
                        }
                        foreach ($kpiTotalOrders[$key] as $res) {
                            $kpiProf = (int)$res->orders0->profit;
                            $kpi += $kpiProf;
                        }
                        $resultAr[$key]["payment"] = (int)$resultAr[$key]["count"] * 350;
                        $resultAr[$key]["kpi"] = ($resultAr[$key]["profit"] / $kpi) * 100;
                    }
                    return $resultAr;
                case 2:
                    $weekStart = date('Y-m-d', strtotime(date('Y').'W'.date('W').'1'));
                    $weekEnd = date('Y-m-d', strtotime(date('Y').'W'.date('W').'7'));
                    $weekLastEnd = date("Y-m-d",(strtotime(date('Y').'W'.date('W').'1'))-86400);
                    $weekLastStart = date("Y-m-d",(strtotime(date('Y').'W'.date('W').'1'))-604800);
                    foreach ($regions as $reg) {
                        $criteria = new CDbCriteria();
                        $kpiCriteria = new CDbCriteria();
                        $criteria->addBetweenCondition('t.date',$weekStart,$weekEnd);
                        $kpiCriteria->addBetweenCondition('t.date',$weekLastStart,$weekLastEnd);
                        $criteria->addCondition('region=' . $reg->id);
                        $criteria->with = "orders0";
                        $kpiCriteria->addCondition('region=' . $reg->id);
                        $kpiCriteria->with = "orders0";
                        $totalOrders[$reg->name] = AdsPay::model()->findAll($criteria);
                        $kpiTotalOrders[$reg->name] = AdsPay::model()->findAll($kpiCriteria);
                    }

                    foreach ($totalOrders as $key => $val) {

                        $kpi = 0;
                        $resultAr[$key]["count"] = count($val);
                        foreach ($val as $ord) {
                            $prof = (int)$ord->orders0->profit;
                            $resultAr[$key]["profit"] += $prof;
                        }
                        foreach ($kpiTotalOrders[$key] as $res) {
                            $kpiProf = (int)$res->orders0->profit;
                            $kpi += $kpiProf;
                        }
                        $resultAr[$key]["payment"] = (int)$resultAr[$key]["count"] * 350;
                        $resultAr[$key]["kpi"] = ($resultAr[$key]["profit"] / $kpi) * 100;
                    }
                    return $resultAr;

                case 3:
                    $firstDay = date("Y-m-1");
                    $lastDay =  date("Y-m-t");
                    $firstDayLast = date("Y-m-1",strtotime('-1 month'));
                    $lastDayLast =  date("Y-m-t",strtotime('-1 month'));
                    foreach ($regions as $reg) {
                        $criteria = new CDbCriteria();
                        $kpiCriteria = new CDbCriteria();
                        $criteria->addBetweenCondition('t.date',$firstDay,$lastDay);
                        $kpiCriteria->addBetweenCondition('t.date',$firstDayLast,$lastDayLast);
                        $criteria->addCondition('region=' . $reg->id);
                        $criteria->with = "orders0";
                        $kpiCriteria->addCondition('region=' . $reg->id);
                        $kpiCriteria->with = "orders0";
                        $totalOrders[$reg->name] = AdsPay::model()->findAll($criteria);
                        $kpiTotalOrders[$reg->name] = AdsPay::model()->findAll($kpiCriteria);
                    }

                    foreach ($totalOrders as $key => $val) {

                        $kpi = 0;
                        $resultAr[$key]["count"] = count($val);
                        foreach ($val as $ord) {
                            $prof = (int)$ord->orders0->profit;
                            $resultAr[$key]["profit"] += $prof;
                        }
                        foreach ($kpiTotalOrders[$key] as $res) {
                            $kpiProf = (int)$res->orders0->profit;
                            $kpi += $kpiProf;
                        }
                        $resultAr[$key]["payment"] = (int)$resultAr[$key]["count"] * 350;
                        $resultAr[$key]["kpi"] = ($resultAr[$key]["profit"] / $kpi) * 100;
                    }
                    return $resultAr;
            }
        }
        elseif($start and $end){
            $start = strtotime($start);
            $end = strtotime($end);
            $startPeriod = date("Y-m-d",$start);
            $endPeriod = date("Y-m-d",$end);
            $y = $end - $start;
            $endLast = $start - 86400;
            $startLast = $endLast - $y;
            $startLastPeriod = date("Y-m-d",$endLast);
            $endLastPeriod = date("Y-m-d",$startLast);
            foreach ($regions as $reg) {
                $criteria = new CDbCriteria();
                $kpiCriteria = new CDbCriteria();
                $criteria->addBetweenCondition('t.date',$startPeriod,$endPeriod);
                $kpiCriteria->addBetweenCondition('t.date',$startLastPeriod,$endLastPeriod);
                $criteria->addCondition('region=' . $reg->id);
                $criteria->with = "orders0";
                $kpiCriteria->addCondition('region=' . $reg->id);
                $kpiCriteria->with = "orders0";
                $totalOrders[$reg->name] = AdsPay::model()->findAll($criteria);
                $kpiTotalOrders[$reg->name] = AdsPay::model()->findAll($kpiCriteria);
            }

            foreach ($totalOrders as $key => $val) {

                $kpi = 0;
                $resultAr[$key]["count"] = count($val);
                foreach ($val as $ord) {
                    $prof = (int)$ord->orders0->profit;
                    $resultAr[$key]["profit"] += $prof;
                }
                foreach ($kpiTotalOrders[$key] as $res) {
                    $kpiProf = (int)$res->orders0->profit;
                    $kpi += $kpiProf;
                }
                $resultAr[$key]["payment"] = (int)$resultAr[$key]["count"] * 350;
                $resultAr[$key]["kpi"] = ($resultAr[$key]["profit"] / $kpi) * 100;
            }
            return $resultAr;
        }
        else{
            foreach ($regions as $reg) {
                $resultAr[$reg->name]["count"] = 0;
                $resultAr[$reg->name]["profit"] = 0;
                $resultAr[$reg->name]["payment"] = 0;
                $resultAr[$reg->name]["kpi"] = 0;
            }
            return $resultAr;
        }
    }
} 