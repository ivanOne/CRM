<?php

class AdsregionController extends Controller
{
	public $layout='//layouts/column2';

	public function actionRegionList()
	{
        $list = AdsRegion::model()->findAll();
		$this->render('regionlist',array(
			'model'=>$list,
		));
	}

	public function actionRegionCreate()
	{
		$model=new AdsRegion;
		if(isset($_POST['AdsRegion']))
		{
			$model->attributes=$_POST['AdsRegion'];
			if($model->save()){
                $tab = new AdsAndRegion();
                $tab->region = $model->id;
                $tab->save();
                $this->redirect(array("adsregion/regionlist"));
            }

		}

		$this->render('regionform',array(
			'model'=>$model,
		));
	}

	public function actionRegionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['AdsRegion']))
		{
			$model->attributes=$_POST['AdsRegion'];
			if($model->save())
				$this->redirect(array('adsRegion/regionlist'));
		}

		$this->render('regionformu',array(
			'model'=>$model,
		));
	}

	public function actionRegionDelete($id)
	{
        $model = AdsAndRegion::model()->find('region=:id',array(':id'=>$id));
        if($model){
            $model->delete();
        }
		$this->loadModel($id)->delete();
        $this->redirect(array('adsregion/regionlist'));
	}

	public function loadModel($id)
	{
		$model=AdsRegion::model()->findByPk($id);
		return $model;
	}


}
