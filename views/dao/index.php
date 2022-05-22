<?php



/* @var $this \yii\web\View
 *@var $data array
 * @var $rand_user_id integer
 * @var $rand_user_email string
 */
?>
<!--<div class="row">
    <div class="col-md-6">
        <pre>
            <?/*= print_r($users)*/?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?/*= print_r($activityUser)*/?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?/*= print_r($user)*/?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            Кол-во:<?/*=$cnt;*/?>
        </pre>
    </div>
    <div class="col-md-6">
        <?php /*foreach ($reader as $item):*/?>
        <?/*= \yii\helpers\ArrayHelper::getValue($item, 'title'); */?>
        <?php /*endforeach;*/?>
    </div>
</div>-->
<p><a href="<?= \yii\helpers\Url::to(['dao/add']) ?>">Наполнить данными</a></p>
<?php if ($data): ?>
    <p>
        <a href="<?= \yii\helpers\Url::to([
            'dao/index',
            'user_id' => $rand_user_id
        ]) ?>">
            Найти все события пользователя ID <?= $rand_user_id ?>
        </a>
    </p>
    <p>
        <a href="<?= \yii\helpers\Url::to([
            'dao/index',
            'user_email' => $rand_user_email
        ]) ?>">
            Найти все события пользователя email <?= $rand_user_email ?>
        </a>
    </p>
    <p><a href="<?= \yii\helpers\Url::to(['dao/clear']) ?>">Очистить данные</a></p>
    <p>Всего событий: <?= count($data) ?></p>
    <?=\app\widgets\daotable\DaoTableWidget::widget(['activities' => $data]);?>
<?php endif; ?>
