<?php

namespace app\controllers;

use app\models\Users;
use yii\helpers\Url;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionSignUp()
    {
        /** @var Users $model */
        $model=\Yii::$app->auth->getModel();

        if(\Yii::$app->request->isPost){
            $model=\Yii::$app->auth->getModel(\Yii::$app->request->post());

            if (\Yii::$app->auth->createUser($model)){
                return $this->redirect(Url::to(['auth/sign-in']));
            }

        }

        return $this->render('signup',['model' => $model]);

    }

    public function actionSignIn()
    {
        /** @var Users $model */
        $model=\Yii::$app->auth->getModel();

        if(\Yii::$app->request->isPost) {
            $model = \Yii::$app->auth->getModel(\Yii::$app->request->post());

            if(\Yii::$app->auth->authUser($model)){

                return $this->redirect(['/activity/create']);
            }
        }

        return $this->render('signin',['model' => $model]);
    }

}