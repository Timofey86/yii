<?php
/* @var $this \yii\web\View
 * @var $model \app\models\Activity
 */

?>

<div class="row">
    <div class="col-md-6">
        <?/*= $name*/?>
      <!--  <?/*= Yii::getAlias('@app'); */?>
        <?/*= Yii::getAlias('@webroot'); */?><br>
        <?/*= Yii::getAlias('@my_alias'); */?><br>
        --><?/*= Yii::getAlias('@page'); */?>
        <?php $form=\yii\bootstrap4\ActiveForm::begin([
                'id'=>'activity-create',
                'method' => 'POST'
        ]); ?>
        <?= $form->field($model,'title'); ?>
        <?= $form->field($model, 'description')->textarea(); ?>
        <?= $form->field($model, 'date_start')->input('date'); ?>
        <?= $form->field($model,'repeat_type')->dropdownList($model->getRepeatTypes()) ?>
        <?= $form->field($model,'is_blocked')->checkbox(); ?>
        <div class="form-group">
            <button type="submit">Отправить</button>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>
    </div>
</div>