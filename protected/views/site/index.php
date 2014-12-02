<?php
/* @var $this SiteController */
Yii::app()->getClientScript()->registerCoreScript( 'jquery' );
Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/font-awesome.min.css')
);



?>
<div class="col-lg-12">
    <h2 class="text-center">Добро пожаловать в <?php echo $this->pageTitle; ?></h2>

<?php $this->renderPartial('_menue')?>
</div>