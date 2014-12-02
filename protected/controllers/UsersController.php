<?php

class UsersController extends Controller
{

	public $layout='//layouts/column2';

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
        $forms = new UsersCreateForm();
		if(isset($_POST['UsersCreateForm']))
		{
			$forms->attributes=$_POST['UsersCreateForm'];
            if($forms->validate()){
                $user = new Users();
                $user->login = $_POST['UsersCreateForm']['login'];
                $user->password = $_POST['UsersCreateForm']['password'];
                $user->email = $_POST['UsersCreateForm']['email'];
                if($user->save()){
                    $up = new UserProfiles();
                    $up->id_user = $user->id;
                    $up->fio = $_POST['UsersCreateForm']['fio'];
                    $up->save();
                }
                $this->redirect(array('view','id'=>$user->id));
            }
		}
		$this->render('create',array(
			'forms'=>$forms
		));
	}

	public function actionUpdate($id)
	{
        $forms = new UsersCreateForm();
        $forms->type='upd';
        $model=$this->loadModel($id);
		if(isset($_POST['UsersCreateForm']))
		{
            $forms->attributes = $_POST['UsersCreateForm'];
            if($forms->validate()){
                $model->login = $_POST['UsersCreateForm']['login'];
                $model->email = $_POST['UsersCreateForm']['email'];
                if(!$_POST['UsersCreateForm']['password']=="")
                    $model->password = $_POST['UsersCreateForm']['password'];
                if($model->save()){
                    $up = UserProfiles::model()->findByPk($id);
                    $up->fio = $_POST['UsersCreateForm']['fio'];
                    $up->save();
                }
                $this->redirect(array('view','id'=>$model->id));
            }

		}
        $roles=RolesUsers::model()->findAllByAttributes(array('id_user'=>$id));
		$this->render('update',array(
			'model'=>$model,'forms'=>$forms,'roles'=>$roles
		));
	}
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
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
