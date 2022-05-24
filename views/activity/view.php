<?php
/**
 * @var $this yii\web\View
 * @var $model \app\models\Activity
 *
 */
echo $model->getDateCreated();
echo yii\helpers\Html::tag('pre', print_r($model->attributes, true));
?>








