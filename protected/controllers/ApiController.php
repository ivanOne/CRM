<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 24.11.2014
 * Time: 11:51
 */

class ApiController extends Controller
{
    public function actionGetSource(){
        $list = Source::model()->findAll();
        $ar = array();
        $i = 0;
        foreach($list as $li){
            $ar[$i]['id'] = $li->id;
            $ar[$i]['name'] = $li->name;
            $i++;
        }
        $arr = json_encode($ar);
        echo $arr;
    }

    public function actionCallOrders()
    {
        if(Yii::app()->request->isPostRequest){
            $data = json_decode($_POST['data']);
            $customer = new Customers();
            $custom = $customer->addCustomers($data->name,$data->family,$data->last_name,$data->city,$data->street,$data->home_num,
                $data->home_apartment,$data->home_housing,$data->home_floor,$data->home_porch,$data->telnum,$data->email,
                $data->index,$data->pasport,$data->intercom);
            if($custom){
                $order = new Orders();
                $order->customer = $custom;
                $order->manager = 0;
                $order->status = 1;
                $order->date = date("Y-m-d H:i:s",time());
                if($order->save()){
                    $ord = Orders::model()->findByPk($order->id);
                    $ord->id_abc = $order->id.$this->cityIndex;
                    $ord->problem = $data->problem;
                    $ord->technics = $data->technics;
                    $ord->source = $data->source;
                    $ord->time = $data->time;
                    $ord->repair_site = $data->repair_site;
                    if($ord->save()){
                        echo $ord->id;
                    }
                }
            }
        }
        else{
            echo null;
        }
    }
} 