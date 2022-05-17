<?php


/* @var $this \yii\web\View */
/* @var $model \app\models\Users */
?>
<div class="row">
    <div class="col-md-6">
        <?php $form=\yii\bootstrap4\ActiveForm::begin([
                'method' => 'POST'
        ]); ?>
        <?= $form->field($model,'email'); ?>
        <?= $form->field($model,'password')->passwordInput(); ?>

        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Регистрация') ?>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>
    </div>
</div>
