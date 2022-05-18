<?php

namespace app\rules;

use yii\rbac\Item;
use yii\rbac\Rule;

class ViewOwnerActivityRule extends Rule
{
    public $name = 'viewOwnerActivityRule';

    public function execute($user, $item, $params)
    {
        $activity = \yii\helpers\ArrayHelper::getValue($params, 'activity');

        return $activity->user_id == $user;
    }
}