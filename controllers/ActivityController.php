<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\ActivityCreateAction;


class ActivityController extends BaseController
{
    public function actions()
    {
        return [
            'create' => ['class'=>ActivityCreateAction::class] //,'name' => 'Timofey'
        //    'new' => ['class'=>ActivityCreateAction::class, 'name' => 'Katja']

        ];
    }
}