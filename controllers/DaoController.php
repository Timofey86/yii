<?php

namespace app\controllers;

use app\components\DaoComponent;
use yii\helpers\Url;
use yii\web\Controller;

class DaoController extends Controller
{
    public function actionIndex()
    {
        /** @var DaoComponent
         */
     /*   $comp=\Yii::createObject(['class' => DaoComponent::class]);

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
            'reader' => $reader]);*/

        //\Yii::$app->cache->set('key1','value1');

//        $val = \Yii::$app->cache->get('key1');
        /*$val = \Yii::$app->cache->getOrSet('key2',function (){
        //    return 'val2';
        });*/

        // \Yii::$app->cache->flush();

//        echo $val;

        //exit;
        $component = $this->daoComponent();

        $options = [];
        if ($user_id = \Yii::$app->request->get('user_id')) {
            $options['user_id'] = $user_id;
        }
        if ($user_email = \Yii::$app->request->get('user_email')) {
            $options['user_email'] = $user_email;
        }


        $data = $component->getActivities($options);
        $rand_user_id = $component->getRandActivityUserId();
        $rand_user_email = $component->getRandActivityUserEmail();

        return $this->render('index', [
            'data' => $data,
            'rand_user_id' => $rand_user_id,
            'rand_user_email' => $rand_user_email
        ]);
    }

    public function actionClear()
    {
        $this->daoComponent()->clear();
        \Yii::$app->session->setFlash('success', 'Данные очищены');
        return $this->redirect(Url::to(['dao/index']));
    }

    public function actionAdd()
    {
        $this->daoComponent()->addRandomData();
        \Yii::$app->session->setFlash('success', 'Данные созданы');

        return $this->redirect(Url::to(['dao/index']));
    }

    private function daoComponent()
    {
        return \Yii::createObject([
            'class' => DaoComponent::class
        ]);
    }

}