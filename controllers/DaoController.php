<?php

namespace app\controllers;

use app\components\DaoComponent;
use yii\web\Controller;

class DaoController extends Controller
{
    public function actionIndex()
    {
        /** @var DaoComponent
         */
        $comp=\Yii::createObject(['class' => DaoComponent::class]);

        $comp->insertsAndUpdates();

        $users = $comp->getAllUsers();
        $activityUser = $comp->getActivityUsers(\Yii::$app->request->get('user', 1));

        $user = $comp->getUser(\Yii::$app->request->get('user',1));
        $cnt = $comp->getCountActivity();
        $reader = $comp->getReaderActivity();

        return $this-> render('index',[
            'users' => $users,
            'activityUser' => $activityUser,
            'user' => $user,
            'cnt' => $cnt,
            'reader' => $reader]);

    }

}