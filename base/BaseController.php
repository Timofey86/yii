<?php

namespace app\base;

use yii\web\Controller;

class BaseController extends Controller
{
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        $url = \Yii::$app->request->url;
        \Yii::$app->session->set('last_page_url',$url);
       // \Yii::$app->session->setFlash('success',$url);
        return $result;
    }

}