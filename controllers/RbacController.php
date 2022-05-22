<?php

namespace app\controllers;

use app\base\BaseController;

class RbacController extends BaseController
{
    public function actionGen()
    {
        \Yii::$app->rbac->generateRbac();

        $data = \Yii::$app->rbac->getDbData();

        return $this->render('init',['data' => $data]);
    }

}