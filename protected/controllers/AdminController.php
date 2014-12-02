<?php


class AdminController extends Controller{

    public $layout='//layouts/column2';

    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    public function actionCreate()
    {
        $model=new Users;

        if(isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            if($model->save()){
                $role = RolesUsers::model()->with('idRole','idUser')->findAllByAttributes(array('id_users'=>$model->id));

                $this->redirect(array('view','id'=>$model->id));
            }

        }
        echo "dsfsdfsd";
        $this->render('create',array(
            'model'=>$model,
        ));
    }


    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);


        if(isset($_POST['Users']))
        {
            $model->attributes=$_POST['Users'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        $model->password = "";
        $this->render('update',array(
            'model'=>$model,
        ));
    }


    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }


    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Users');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }


    public function actionAdmin()
    {
        $model=new Users('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Users']))
            $model->attributes=$_GET['Users'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    public function loadModel($id)
    {
        $model=Users::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
} 