<?php

namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\ActivityCreateAction;
use app\models\Activity;
use app\models\ActivitySearch;
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
        $model = new ActivitySearch();
        $provider = $model->getDataProvider(\Yii::$app->request->queryParams);

        return $this->render('index',['model' => $model, 'provider' => $provider]);
    }

    public function actionView($id)
    {
        $model = Activity::find()->andWhere(['id' => $id])->one();

        if(!$model){
            throw new HttpException(401,'Событие не найдено');
        }

        if (!\Yii::$app->rbac->canViewActivity($model)){
            throw new HttpException(403,'У вас нет прав просмотра данного события');
        }

        return $this->render('view',['model'=> $model]);
    }
}