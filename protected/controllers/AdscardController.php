<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 23.10.2014
 * Time: 16:16
 */

class AdscardController extends Controller
{
    public function actionAdsCards(){
        $this->setPageTitle("Карточки расклейщиков");
        $list = AdsProfile::model()->findAll();
        $this->render('cardList',array('profiles'=>$list));
    }

    public function actionAdsCardDelete($id){
        AdsAndRegion::model()->updateAll(array("ads"=>null),'ads=:ida',array(":ida"=>$id));
        $model = AdsProfile::model()->findByPk(":id","",array(":id"=>$id));
        $model->delete();
        $this->redirect(array('ads/adscard'));
    }

    public function actionAdsCardCreate(){
        $this->setPageTitle("Создание карточки расклейщика");
        $form = new AdsCardForm();
        if(isset($_POST['AdsCardForm'])){
            $form->attributes = $_POST['AdsCardForm'];
            if($form->validate()){
                $model = new AdsProfile();
                $pas['vydan'] = $_POST['AdsCardForm']['vydan'];
                $pas['data_v'] = $_POST['AdsCardForm']['data_v'];
                $pas['kod'] = $_POST['AdsCardForm']['kod'];
                $pas['num_pas'] = $_POST['AdsCardForm']['num_pas'];
                $pas['mesto_r'] = $_POST['AdsCardForm']['mesto_r'];
                $pas['registration'] = $_POST['AdsCardForm']['registration'];
                $model->fio = $_POST['AdsCardForm']['fio'];
                $model->telnum = $_POST['AdsCardForm']['telephone'];
                $model->propiska = $_POST['AdsCardForm']['registration'];
                $model->dob = $_POST['AdsCardForm']['dob'];
                $model->first_day = $_POST['AdsCardForm']['date_start'];
                $model->passport = json_encode($pas);
                $model->save();
                $this->redirect(array('adscard/adscards','id'=>$model->id));
            }
        }
        $this->render('cardform',array('model'=>$form));
    }

    public function actionAdsCardUpdate($id){
        $this->setPageTitle("Создание карточки расклейщика");
        $form = new AdsCardForm();
        if(isset($_POST['AdsCardForm'])){
            $form->attributes = $_POST['AdsCardForm'];
            if($form->validate()){
                $model = AdsProfile::model()->findByPk($id);
                $pas['vydan'] = $_POST['AdsCardForm']['vydan'];
                $pas['data_v'] = $_POST['AdsCardForm']['data_v'];
                $pas['kod'] = $_POST['AdsCardForm']['kod'];
                $pas['num_pas'] = $_POST['AdsCardForm']['num_pas'];
                $pas['mesto_r'] = $_POST['AdsCardForm']['mesto_r'];
                $pas['registration'] = $_POST['AdsCardForm']['registration'];
                $model->fio = $_POST['AdsCardForm']['fio'];
                $model->telnum = $_POST['AdsCardForm']['telephone'];
                $model->propiska = $_POST['AdsCardForm']['registration'];
                $model->dob = $_POST['AdsCardForm']['dob'];
                $model->first_day = $_POST['AdsCardForm']['date_start'];
                $model->passport = json_encode($pas);
                $model->save();
                $this->redirect(array('adscard/adscards','id'=>$model->id));
            }
        }
        $data = AdsProfile::model()->findByPk($id);
        $this->render('cardformu',array('model'=>$form,'data'=>$data));
    }
} 