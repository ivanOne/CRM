<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 27.10.2014
 * Time: 11:15
 */

class AdsbaseController extends Controller
{
    public function actionBaseList(){
        $criteria = new CDbCriteria();
        $criteria->order = "region ASC";
        $data = AdsAndRegion::model()->findAll($criteria);
        $this->render('list',array('data'=>$data));
    }

    public function actionBaseUpdate(){
        $id = $_POST['list'];
        $data = AdsAndRegion::model()->find("region=:region",array(":region"=>$_POST['region']));
        $data->ads = $id;
        $data->save();
        $this->redirect(array('adsbase/baselist'));

    }

    public function actionDailyReportList(){
        if(!isset($_GET['date'])){
            $now = date("Y-m",time());
            $pre = date("Y-m",strtotime("-1 month"));
            $next = date("Y-m",strtotime("+1 month"));

        }
        else{
            $now = $_GET['date'];
            $pre = date("Y-m",strtotime($_GET['date']."-01 -1 month"));
            $next = date("Y-m",strtotime($_GET['date']."-01 +1 month"));
        }
        $criteria = new CDbCriteria();
        $criteria->select = "date_report";
        $criteria->group = "date_report";
        $data = DailyReports::model()->findAll($criteria);
        $dateMass = array();
        foreach($data as $dat){
            $dateMass[] = $dat->date_report;
        }
        $this->render("reportlist",array('dates'=>$dateMass,'now'=>$now,'pre'=>$pre,'next'=>$next));
    }

    public function actionDailyReportCreate(){
        $date = date("Y-m-d",strtotime($_GET['date']));
        $ma = DailyReports::model()->count('date_report=:date',array(':date'=>$date));
        if(!$ma>0){
            $mass = AdsAndRegion::model()->with('region0','ads0')->findAll();
            foreach($mass as $item){
                $mod = new DailyReports();
                $mod->date_report = $date;
                $mod->ads = $item->ads0->fio;
                $mod->region = $item->region0->name;
                $mod->quantity = 0;
                $mod->save();
            }
        }
        else{
            $this->redirect(array('adsbase/dailyreportview','date'=>$date));
        }

        $this->redirect(array('adsbase/dailyreportview','date'=>$date));
    }

    public function actionDailyReportView($date){
        $date = date("Y-m-d",strtotime($date));
        $grid = DailyReports::model()->findAll('date_report=:date',array(':date'=>$date));
        $this->render('view',array('grid'=>$grid,'date'=>$date));
    }

    public function actionDailyReportUpdate(){
        foreach ($_POST['quantity'] as $key => $item) {

            DailyReports::model()->updateByPk($key,array('quantity'=>$item['quantity'],'start'=>$item['start'],'end'=>$item['end']));

        }
        $this->redirect(array("adsbase/dailyreportlist"));

    }

    public function drawCalendar($month = '',$year='',$dateMass = array()){
        /* Начало таблицы */
        $calendar = '<table class="table table-bordered cal">';
        /* Заглавия в таблице */
        $headings = array('Понедельник','Вторник','Среда','Четверг','Пятница','Субота','Воскресенье');
        $calendar.= '<tr><td>'.implode('</td><td>',$headings).'</td></tr>';
        /* необходимые переменные дней и недель... */
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $running_day = $running_day - 1;
        if($running_day == -1) $running_day = 6;
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        $day_counter = 0;
        /* первая строка календаря */
        $calendar.= '<tr>';
        /* вывод пустых ячеек в сетке календаря */
        for($x = 0; $x < $running_day; $x++):
            $calendar.= '<td cli=0> </td>';
            $days_in_this_week++;
        endfor;
        /* дошли до чисел, будем их писать в первую строку */
        for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            if($list_day<10){
                $str = "".$year."-".$month."-0".$list_day;
            }else{
                $str = "".$year."-".$month."-".$list_day;
            }


            if(in_array($str,$dateMass)){
                $calendar.= '<td class="yes" cli=1 date='.$year.'-'.$month.'-'.$list_day.'>';
                /* Пишем номер в ячейку */
                $calendar.= '<div>'.$list_day.'</div>';

                $calendar.= '</td>';
            }
            else{
                $calendar.= '<td class="no" cli=1 date='.$year.'-'.$month.'-'.$list_day.'>';
                /* Пишем номер в ячейку */
                $calendar.= '<div>'.$list_day.'</div>';

                $calendar.= '</td>';
            }

            if($running_day == 6):
                $calendar.= '</tr>';
                if(($day_counter+1) != $days_in_month):
                    $calendar.= '<tr>';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++; $running_day++; $day_counter++;
        endfor;
        /* Выводим пустые ячейки в конце последней недели */
        if(($days_in_this_week < 8)and($days_in_this_week !=1)):
            for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar.= '<td cli=0> </td>';
            endfor;
        endif;
        /* Закрываем последнюю строку */
        $calendar.= '</tr>';
        /* Закрываем таблицу */
        $calendar.= '</table>';

        /* Все сделано, возвращаем результат */
        echo $calendar;
    }
} 