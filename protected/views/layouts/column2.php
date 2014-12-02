<?php /* @var $this Controller */
    Yii::app()->getClientScript()->registerCoreScript( 'jquery' );
    Yii::app()->clientScript->registerCssFile(
    CHtml::asset(Yii::app()->request->baseUrl.'css/font-awesome.min.css')
    );
?>
<?php $this->beginContent('//layouts/main'); ?>
    <div class="col-lg-2">
        <div id="sidebar">
            <?php
            $this->beginWidget('zii.widgets.CPortlet');?>

            <?php
            $this->widget('zii.widgets.CMenu', array(
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'nav nav-pills nav-stacked'),
            ));
            $this->endWidget();
            ?>
            <div class="row">
                <div class=" col-sm-12 text-center hidden" id="but">
                    <i class="fa fa-bars fa-3x"></i>
                </div>
            </div>
        </div><!-- sidebar -->

        <?  $this->widget('application.components.Time.TimeWidget'); ?>
    </div>
    <div class="col-lg-10">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>

<?php $this->endContent(); ?>