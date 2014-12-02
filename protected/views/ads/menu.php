<?php
$this->breadcrumbs = array(
    'Панель управления HR'=>array('hr/hrindex'),
    'Панель управления расклейкой'
);
Yii::app()->getClientScript()->registerCoreScript( 'jquery' );
Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/font-awesome.min.css')
);
?>
<div class="col-lg-12">
    <h2 class="text-center">Расклейщики</h2>
    <div class="row">
        <div class="col-lg-10 col-md-offset-1 men">
            <div class="row">
                <div class="col-lg-2">
                    <a href="<?php echo Yii::app()->createUrl('adscard/adscards')?>" class="text-center menue">
                        <div>
                            <i class="fa fa-database fa-5x"></i><p>Карточки расклейщиков</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2">
                    <a href="<?php echo Yii::app()->createUrl('adsregion/regionlist')?>" class="text-center menue">
                        <div>
                            <i class="fa fa-globe fa-5x"></i><p>Список районов</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2">
                    <a href="<?php echo Yii::app()->createUrl('adsbase/baselist')?>" class="text-center menue">
                        <div>
                            <i class="fa fa-folder-o fa-5x"></i><p>Расклейщики и районы</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2">
                    <a href="<?php echo Yii::app()->createUrl('adsbase/dailyreportlist')?>" class="text-center menue">
                        <div>
                            <i class="fa fa-file-text  fa-5x"></i><p>Ежедневный отчет</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2">
                    <a href="<?php echo Yii::app()->createUrl('adsarch/adsarchlist')?>" class="text-center menue">
                        <div>
                            <i class="fa fa-th fa-5x"></i><p>Журнал расклейки</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2">
                    <a href="<?php echo Yii::app()->createUrl('ads/adsmaterials')?>" class="text-center menue">
                        <div>
                            <i class="fa fa-archive fa-5x"></i><p>Материалы</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2">
                    <a href="<?php echo Yii::app()->createUrl('ads/adsact')?>" class="text-center menue">
                        <div>
                            <i class="fa fa-list-alt fa-5x"></i><p>Акт приема передачи материалов</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>