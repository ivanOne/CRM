<div class="row">
    <div class="col-lg-10 col-md-offset-1 men">
        <div class="row">
            <? if(Yii::app()->user->role != 5){ ?>
            <div class="col-lg-2">
                <a href="<?php echo Yii::app()->createUrl('orders/index')?>" class="text-center menue">
                    <div>
                       <i class="fa fa-bar-chart fa-5x"></i><p>Заказы</p>
                    </div>
                </a>
            </div>
            <?}?>
            <? if(Yii::app()->user->role == 5 or Yii::app()->user->role == 1){ ?>
            <div class="col-lg-2 ">
                <a href="<?php echo Yii::app()->createUrl('hr/hrindex'); ?>" class="text-center menue">
                    <div>
                        <i class="fa fa-users fa-5x"></i><p>Управление персоналом</p>
                    </div>
                </a>
            </div>
            <? } ?>
            <? if(Yii::app()->user->role == 6 or Yii::app()->user->role == 1): ?>

            <? endif ?>
        </div>
    </div>
</div>