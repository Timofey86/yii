<?php

namespace app\controllers\actions;

use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;

class ActivityCreateAction extends Action
{
    //public $name;

    public function run()
    {
        /** @var ActivityComponent $comp */
        $comp=\Yii::$app->activity;
      /*  $comp=\Yii::createObject([
            'class'=>ActivityComponent::class,
            'model_class' => Activity::class]);*/
        $model =$comp->getModel();

        if(\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if ($comp->createActivity($model)){

            }

        }

        return $this->controller->render('create',['model'=> $model]);// ,'name'=>$this->name
    }

}