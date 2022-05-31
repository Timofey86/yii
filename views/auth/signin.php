<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\Users */
\app\views\auth\assets\AuthAsset::register($this)
//$this->registerCssFile(''); пример подключения на одной странице
?>

<div class="row">
    <div class="col-md-6">
        <?php $form=\yii\bootstrap4\ActiveForm::begin([
            'method' => 'POST'
        ]); ?>
        <?= $form->field($model,'email'); ?>
        <?= $form->field($model,'password')->passwordInput(); ?>

        <div class="form-group">
            <?= \yii\helpers\Html::submitButton('Авторизоваться') ?>
        </div>
        <p><b>admin@mail.ru / 123456</b></p>
        <p><b>user@mail.ru / 123456</b></p>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>
    </div>
</div>
