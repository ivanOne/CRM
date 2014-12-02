<?php /* @var $this Controller */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/template.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/template.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="top navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <a href="<? echo Yii::app()->createUrl('');?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="Лого"/></a>
            </div>
            <? if(!Yii::app()->user->isGuest){?>
                <div class="col-lg-1 navbar-right "><a href="<? echo Yii::app()->createUrl('site/logout'); ?>" class="btn btn-danger logout">Выход</a></div>
            <? } ?>
                <?php /*$this->widget('zii.widgets.CMenu',array(
                    'htmlOptions' => array(
                        'class' => 'nav navbar-nav'
                    ),
                    'items'=>array(
                        array('label'=>'Пользователи', 'url'=>array('/users/index')),
                        array('label'=>'Роли', 'url'=>array('/roles/index')),

                    ),
                )); */?>
        </nav>

    </div>
</div>
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-12 bread">

            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                    'homeLink'=>CHtml::link('Главная',array('site/index'))
                )); ?><!-- breadcrumbs -->
            <?php endif?>
        </div>
        <?
        $this->beginWidget('HeadLine',array('html'=>$this->html,'addClass'=>$this->widgetClass));
        $this->endWidget();
        ?>
    </div>
    <div class="row">
        <?php echo $content; ?>
    </div>
</div><!-- page -->

</body>
</html>
