<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 17.10.2014
 * Time: 10:25
 */

class EmployeeController extends Controller {

    public function actionEmployeeList($role="4"){
        $criteria = new CDbCriteria();
        $criteria->addCondition('id_role != 1 and id_role ='.$role.'');
        $criteria->with=array('idRole','idUser','fio');
        $data = RolesUsers::model()->findAll($criteria);
        $this->render('list',array('data'=>$data,'li'=>$role));
    }

    public function actionEmployeeProfile($id){
        $criteria = new CDbCriteria();
        $criteria->condition='t.id_user = :id';
        $criteria->params = array(':id'=>$id);
        $criteria->with=array('idRole','idUser','fio');
        $profile = RolesUsers::model()->find($criteria);
        $this->render('profile',array('profile'=>$profile));
    }

    public function actionEmployeeUpdate($id){
        $form = new EmployeeForm();
        $criteria = new CDbCriteria();
        if($_POST['EmployeeForm']){
            $form->attributes = $_POST['EmployeeForm'];
            if($form->validate()){
                $profile = UserProfiles::model()->find('id_user='.$id);
                $pas['vydan'] = $_POST['EmployeeForm']['vydan'];
                $pas['data_v'] = $_POST['EmployeeForm']['data_v'];
                $pas['kod'] = $_POST['EmployeeForm']['kod'];
                $pas['num_pas'] = $_POST['EmployeeForm']['num_pas'];
                $pas['mesto_r'] = $_POST['EmployeeForm']['mesto_r'];
                $pas['registration'] = $_POST['EmployeeForm']['registration'];
                $other['curator'] = $_POST['EmployeeForm']['curator'];
                $profile->fio = $_POST['EmployeeForm']['fio'];
                $profile->telephone = $_POST['EmployeeForm']['telephone'];
                $profile->propiska = $_POST['EmployeeForm']['registration'];
                $profile->dob = $_POST['EmployeeForm']['dob'];
                $profile->first_day = $_POST['EmployeeForm']['date_start'];
                $profile->other = json_encode($other);
                $profile->passport = json_encode($pas);
                $profile->save();
                $this->redirect(array('employee/employeeprofile','id'=>$id));
            }
        }
        $criteria->condition='t.id_user = :id';
        $criteria->params = array(':id'=>$id);
        $criteria->with=array('idRole','idUser','fio');
        $profile = RolesUsers::model()->find($criteria);
        $this->render('update',array('form'=>$form,'profile'=>$profile));
    }

    public function actionEmployeeReport($id,$name,$time="",$start="",$end=""){
        $role = RolesUsers::model()->find('id_user=:id',array(':id'=>$id));
        $filter = new EmploFilter();
        switch($role->id_role) {
            case 4:
                $result = $filter->emploReportFilter($id, $time, $start, $end, "engineer");
                $this->render('reportEngenier', array('count' => $result['count'], "orders" => $result["list"], "fail" => $result['fail'], "kpi" => $result['kpi'],
                    'day' => $result['day'], 'start' => $start, 'end' => $end, 'time' => $time, 'id' => $id, 'name' => $name));
                break;
            case 3:
                $result = $filter->emploReportFilter($id, $time, $start, $end, "manager");
                $this->render('reportManager', array('count' => $result['count'], "orders" => $result["list"], "kpi" => $result['kpi'],
                    'day' => $result['day'], 'start' => $start, 'end' => $end, 'time' => $time, 'id' => $id, 'name' => $name));
                break;
            case 5:
                $result = $filter->HrReportFilter($time,$start,$end);
                $this->render('reportHr',array("orders"=>$result,'start'=>$start,'end'=>$end,'time'=>$time,'id'=>$id));
                break;
        }
    }

} 