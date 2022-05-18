<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\ActivityCreateAction;
use app\models\Activity;
use yii\web\HttpException;


class ActivityController extends BaseController
{
    public function actions()
    {
        return [
            'create' => ['class'=>ActivityCreateAction::class] //,'name' => 'Timofey'
        //    'new' => ['class'=>ActivityCreateAction::class, 'name' => 'Katja']

        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        $model = Activity::find()->andWhere(['id' => $id])->one();

        if(!$model){
            throw new HttpException(401,'activity not found');
        }

        if (!\Yii::$app->rbac->canViewActivity($model)){
            throw new HttpException(403,'not access show activity');
        }

        return $this->render('view',['model'=> $model]);
    }
}