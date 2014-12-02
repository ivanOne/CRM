<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 29.09.2014
 * Time: 14:33
 */

class OrdersController extends Controller {

    public function actionCreateOrder(){
        $model = new OrdersForm();
        if(isset($_POST['OrdersForm'])){
            $model->attributes = $_POST['OrdersForm'];
            if($model->validate()){
                $customer = new Customers();
                $custom = false;

                if(isset($_POST['ag'])){
                    $customerAgent = $customer->addCustomers($model->name1,$model->family1,$model->last_name1,$model->city1,$model->street1,
                        $model->home_num1,$model->home_apartment1,$model->home_housing1,$model->home_floor1,$model->home_porch1,
                        $model->telnum1,$model->email,$model->pasport,$model->index);
                    if($customerAgent){
                        $custom = $customer->addCustomers($model->name,$model->family,$model->last_name,$model->city,$model->street,
                            $model->home_num,$model->home_apartment,$model->home_housing,$model->home_floor,$model->home_porch,
                            $model->telnum,$model->email,$model->index,$model->pasport,$customerAgent);
                    }
                }
                else{

                    $custom = $customer->addCustomers($model->name,$model->family,$model->last_name,$model->city,$model->street,
                        $model->home_num,$model->home_apartment,$model->home_housing,$model->home_floor,$model->home_porch,
                        $model->telnum,$model->email,$model->index,$model->pasport);
                }
                if($custom){
                    $order = new Orders();
                    $order->customer = $custom;
                    $order->manager = Yii::app()->user->id;
                    $order->status = $model->status;
                    $order->date = date("Y-m-d H:i:s",time());
                    if($order->save()){
                        $ord = Orders::model()->findByPk($order->id);
                        $ord->id_abc = $order->id.$this->cityIndex;
                        $ord->problem = $model->problem;
                        $ord->technics = $model->technics;
                        $ord->source = $model->source;
                        $ord->status = $model->status;
                        $ord->time = $model->time;
                        $ord->courier = $model->courier;
                        $ord->engineer = $model->engineer;
                        if($ord->engineer){
                            $this->sendingMail($order->id,$ord->engineer);
                        }
                        $ord->returns = $model->returns;
                        $ord->repair_site = $model->repair_site;
                        $ord->save();
                    }
                }
                $this->redirect(Yii::app()->createUrl('orders/index'));
            }
            else{
                $order_id = Orders::model()->getPrimaryKey();
                $this->render('create',array('model'=>$model,'pid'=>$order_id));
            }
        }
        else{

            $fieldCriteria = new CDbCriteria(array(
                'order' => 'id DESC',
                'limit' => 1
            ));
            $order_id = Orders::model()->find($fieldCriteria);
            $pid = (int)$order_id->id;
            $pid++;
            $this->render('create',array('model'=>$model,'pid'=>$pid));
        }

    }

    public function actionIndex($date = null,$status = '',$num = '',$people = '',$numsearch = '',$telnum = ''){
        $criteria = new CDbCriteria();
        if($date != null){
            switch($date){
                case 1:
                    $dat = date('Y-m-d',time());
                    $criteria->addBetweenCondition('date',$dat,$dat." 23:59:59");
                    break;
                case 2:
                    $dat = date('Y-m-d',strtotime('-1 day'));
                    $criteria->addBetweenCondition('date',$dat,$dat." 23:59:59");
                    break;
                case 3:
                    $weekStart = date('Y-m-d', strtotime(date('Y').'W'.date('W').'1'));
                    $weekEnd = date('Y-m-d', strtotime(date('Y').'W'.date('W').'7'));
                    $criteria->addBetweenCondition('date',$weekStart,$weekEnd);
                    break;
                case 4:
                    $firstDay = date("Y-m-1");
                    $lastDay =  date("Y-m-t");
                    $criteria->addBetweenCondition('date',$firstDay,$lastDay);
                    break;
            }
        }
        if($status){
            $criteria->addCondition('status='.$status);
        }
        else{
            $criteria->addCondition('status=1 or status=2');
        }
        if($num){
            $criteria->addBetweenCondition('date',$num." 00:00:00",$num." 23:59:59");
        }
        if($numsearch){
            $criteria->addSearchCondition('id_abc',$numsearch);
        }
        if($telnum){
            $criteria->addSearchCondition('fio.telnum',$telnum);
        }
        if(Yii::app()->user->role==4){
            $criteria->addCondition('status=2 and engineer='.Yii::app()->user->id);
        }
        $criteria->with=array('couriers','stat','fio','ing','man');
        $dataProvider = new CActiveDataProvider('Orders',array(
                'criteria'=>$criteria,
                'sort'=>array(
                    'defaultOrder'=>array(
                        'id'=>'CSort::SORT_DESC',
                    )
                )
            )
        );

        $this->render('index',array('data'=>$dataProvider,'date'=>$date,'stat'=>$status,'num'=>$num,'people'=>$people,
            'numsearch'=>$numsearch,'telnum'=>$telnum));
    }

    public function actionView($id){
        $model = Orders::model()->with('fio')->findByPk($id);
        $form = new OrdersForm();
        $this->render('view',array('id'=>$id,'model'=>$model,'form'=>$form));
    }

    public function actionUpdate(){
        $model = Orders::model()->findByPk($_POST['id']);
        $formModel = new OrdersForm();
        $formModel->attributes = $_POST['OrdersForm'];
        if(isset($_POST['service'])){
            $formModel->service = $formModel->getService();
        }
        if(isset($_POST['partsName'])and isset($_POST['partsPrice'])){
            $formModel->parts = $formModel->getParts();
        }

        if($formModel->validate()){
            $customer = new Customers();
            $custom = false;
            if(isset($_POST['ag'])){
                if(isset($_POST['id_user_ag'])){
                    $customerAgent = $customer->updateCustomers($_POST['id_user_ag'],$formModel->name1,$formModel->family1,$formModel->last_name1,$formModel->city1,$formModel->street1,
                        $formModel->home_num1,$formModel->home_apartment1,$formModel->home_housing1,$formModel->home_floor1,$formModel->home_porch1,
                        $formModel->telnum1,$formModel->email,$formModel->index,$formModel->pasport,$formModel->intercom);
                    if($customerAgent){
                        $custom = $customer->updateCustomers($_POST['id_user'],$formModel->name,$formModel->family,$formModel->last_name,$formModel->city,$formModel->street,
                            $formModel->home_num,$formModel->home_apartment,$formModel->home_housing,$formModel->home_floor,$formModel->home_porch,
                            $formModel->telnum,$formModel->email,$formModel->index,$formModel->pasport,$formModel->intercom,$customerAgent);
                    }
                }
                else{
                    $customerAgent = $customer->addCustomers($formModel->name1,$formModel->family1,$formModel->last_name1,$formModel->city1,$formModel->street1,
                        $formModel->home_num1,$formModel->home_apartment1,$formModel->home_housing1,$formModel->home_floor1,$formModel->home_porch1,
                        $formModel->telnum1,$formModel->email,$formModel->index,$formModel->pasport,$formModel->intercom);
                    if($customerAgent){
                        $custom = $customer->updateCustomers($_POST['id_user'],$formModel->name,$formModel->family,$formModel->last_name,$formModel->city,$formModel->street,
                            $formModel->home_num,$formModel->home_apartment,$formModel->home_housing,$formModel->home_floor,$formModel->home_porch,
                            $formModel->telnum,$formModel->email,$formModel->index,$formModel->pasport,$formModel->intercom,$customerAgent);
                    }
                }
            }
            else{
                if(isset($_POST['id_user_ag'])){
                    Customers::model()->deleteByPk($_POST['id_user_ag']);
                }
                $custom = $customer->updateCustomers($_POST['id_user'],$formModel->name,$formModel->family,$formModel->last_name,$formModel->city,$formModel->street,
                    $formModel->home_num,$formModel->home_apartment,$formModel->home_housing,$formModel->home_floor,$formModel->home_porch,
                    $formModel->telnum,$formModel->email,$formModel->index,$formModel->pasport,$formModel->intercom,"NULL");
            }
            if($custom){
                $model->attributes = $formModel->attributes;
                if($model->attributes['engineer']){
                    $status = Orders::model()->findByPk($model->attributes['id']);
                    if(($status->status=="1")or($status->engineer != $model->attributes['engineer'])){
                        $this->sendingMail($model->id,$model->attributes['engineer']);
                    }
                }
                $model->manager = $_POST['manager'];
                $model->save();
                $this->redirect(Yii::app()->createUrl('orders/index'));
            }
        }
    }

    public function actionArchiveOrder($date = '',$status = '',$num = '',$people = '',$numsearch = '',$telnum = ''){
        $criteria = new CDbCriteria();
        if($date){
            switch($date){
                case 0:
                    $dat = date('Y-m-d',time());
                    $criteria->addCondition('date = '.$dat);
                    break;
                case 1:
                    $dat = date('Y-m-d',strtotime('-1 day'));
                    $criteria->addBetweenCondition('date',$dat,$dat." 23:59:59");
                    break;
                case 2:
                    $weekStart = date('Y-m-d', strtotime(date('Y').'W'.date('W').'1'));
                    $weekEnd = date('Y-m-d', strtotime(date('Y').'W'.date('W').'7'));
                    $criteria->addBetweenCondition('date',$weekStart,$weekEnd);
                    break;
                case 3:
                    $firstDay = date("Y-m-1");
                    $lastDay =  date("Y-m-t");
                    $criteria->addBetweenCondition('date',$firstDay,$lastDay);
                    break;
            }
        }
        if($status){
            $criteria->addCondition('status='.$status);
        }
        else{
            $criteria->addCondition('t.status=3 or t.status=4 or t.status = 5');
        }
        if($num){
            $criteria->addBetweenCondition('date',$num." 00:00:00",$num." 23:59:59");
        }
        if($numsearch){
            $criteria->addSearchCondition('id_abc',$numsearch);
        }
        if($telnum){
            $criteria->addSearchCondition('fio.telnum',$telnum);
        }
        $criteria->with=array('couriers','stat','fio','ing','man','sou');
        $dataProvider = new CActiveDataProvider('Orders',array(
                'criteria'=>$criteria,
                'sort'=>array(
                    'defaultOrder'=>array(
                        'id'=>'CSort::SORT_DESC',
                    )
                )
            )
        );
        $this->render('archive',array('data'=>$dataProvider,'date'=>$date,'stat'=>$status,'num'=>$num,'people'=>$people,'numsearch'=>$numsearch,'telnum'=>$telnum));
    }

    public function actionTodayReport($time = "1"){
        $condition = null;
        $view = "";
        switch(Yii::app()->user->role){
            case 3:
                $condition = $this->todReport($time);
                $view = '_adminReport';
                break;
            case 1:
                $condition = $this->todReport($time);
                $view = '_adminReport';
                break;
            case 4:
                $condition = $this->todReport($time,Yii::app()->user->id);
                $view = '_engReport';
                break;
        }
        $data = Orders::model()->with('ing')->findAll($condition);
        $this->render('todayReport',array('data' => $data,'view'=>$view));
    }

    public function todReport($time,$engineer=null){
        $condition = new CDbCriteria();
        $condition->addCondition('status = 3');
        if($engineer != null){
            $condition->addCondition('engineer='.$engineer);
        }
        switch($time){
            case 1:
                $today = date("Y-m-d",time());
                $condition->addCondition('time_close = "'.$today.'"');
                break;
            case 2:
                $yeasterDay = date("Y-m-d",strtotime("-1 day"));
                $condition->addCondition('time_close = "'.$yeasterDay.'"');
                break;
            case 3:
                $weekStart = date('Y-m-d', strtotime(date('Y').'W'.date('W').'1'));
                $weekEnd = date('Y-m-d', strtotime(date('Y').'W'.date('W').'7'));
                $condition->addBetweenCondition('time_close',$weekStart,$weekEnd);
                break;
            case 4:
                $firstDay = date("Y-m-1");
                $lastDay =  date("Y-m-t");
                $condition->addBetweenCondition('time_close',$firstDay,$lastDay);
                break;
        }
        return $condition;
    }

    public function sendingMail($id,$engineer){
        $engineer = Users::model()->findByPk($engineer);
        $order = Orders::model()->with('fio','man')->findByPk($id);
        $addr = json_decode($order->fio->home);
        $to = $engineer->email;
        $time = null;
        if($order->time == null){
            $time = "Офис";
        }
        elseif($order->time === "0000-00-00 00:00:00"){
            $time = "0000-00-00 00:00:00";
        }
        else{
            $time = date("H:i d.m.Y",strtotime($order->time));
        }
        $subject = "Вы назначены исполнителем по заказу #".$id.$this->cityIndex;
        $message = "<table style='border: 1px solid black; border-collapse: collapse;'>
            <tr>
                <td style='border: 1px solid black'>Клиент</td>
                <td style='border: 1px solid black'>".$order->fio->fio."</td>
            </tr>
            <tr>
                <td style='border: 1px solid black'>Телефон</td>
                <td style='border: 1px solid black'>".$order->fio->telnum."</td>
            </tr>
            <tr>
                <td style='border: 1px solid black'>Адрес</td>
                <td style='border: 1px solid black'>".$order->fio->city.", улица ".$order->fio->street." дом ".$addr->home_num." корпус ".$addr->home_housing."\n этаж ".$addr->home_floor." квартира ".$addr->home_appartment." подъезд ".$addr->home_porch." код подъезда ".$order->fio->intercom."</td>
            </tr>
            <tr>
                <td style='border: 1px solid black'>Проблема</td>
                <td style='border: 1px solid black'>".$order->problem."</td>
            </tr>
            <tr>
                <td style='border: 1px solid black'>Техника</td>
                <td style='border: 1px solid black'>".$order->technics."</td>
            </tr>
            <tr>
                <td style='border: 1px solid black'>Место проведения ремонта</td>
                <td style='border: 1px solid black'>".$time."</td>
            </tr>
        </table>";
        mail($to,$subject,$message,"Content-type: text/html\r\n");
    }
} 