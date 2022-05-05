<?php

//echo yii\helpers\Html::tag('pre', print_r($model->images, true));
?>







<div class="row">
    <div class="col-md-12">
        <?= \yii\helpers\Html::tag('p','Описание:'.$model->description)?>
        <p>Название:<strong><?= \yii\helpers\Html::encode($model->title)?></strong></p>
        <p><?php foreach ($model->images as $image):?></p>
        <?= \yii\helpers\Html::img('/images/'.$image, ['width'=>150]); ?>
        <?php endforeach;?>
        <!--<p><?/*= \yii\helpers\Html::img('/images/'.$model->file, ['width'=>150])*/?></p>-->
    </div>
</div>
