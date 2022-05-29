<?php

namespace app\commands;

use app\components\ActivityComponent;
use app\components\NotificationComponent;
use app\models\Activity;
use yii\console\Controller;
use yii\db\ActiveRecord;
use yii\helpers\Console;

class NotificationController extends Controller
{
    public $name;
    public $from;

    public function options($actionID)
    {
        return [
//            'name'
            'from'
        ];
    }

    public function optionAliases()
    {
        return [
            'n' => 'name',
            'f' => 'from'
        ];
    }

    public function actionTest()
    {
        echo 'this is terminal'.PHP_EOL;
//        print_r($args);
//        echo $name.PHP_EOL;
        echo $this->ansiFormat($this->name,Console::FG_CYAN).PHP_EOL;
    }

    /** @var ActiveRecord $repository  */
    public function actionSendNotifications()
    {
        $repository = \Yii::createObject(['class' => ActivityComponent::class, 'model_class' => Activity::class]);
        $activities = $repository->getActivityFroNotification($this->from);

        /**
         * @var NotificationComponent $notification
         */
        $notification = \Yii::createObject(['class' => NotificationComponent::class,
            'mailer' => \Yii::$app->mailer]);

        $notification->sendNotifications($activities);

    }

}