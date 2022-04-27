<?php

namespace app\base;

use yii\web\Controller;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        $result = parent::beforeAction($action);

        $url = \Yii::$app->request->url;
        //\Yii::$app->session->setFlash('last_page_url',$url);
        \Yii::$app->session->setFlash('success',$url);
        return $result;
    }

}