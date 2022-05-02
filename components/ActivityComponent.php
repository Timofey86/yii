<?php

namespace app\components;

use app\models\Activity;
use yii\base\Component;
use yii\db\Exception;

class ActivityComponent extends Component
{
    public $model_class;

    public function init()
    {
        parent::init();

        if (empty($this->model_class)){
            throw new \Exception('Need model_class param');
        }
    }


    public function getModel()
    {
        return new $this->model_class;
    }
/* @var Activity $model */
    public function createActivity(&$model, $post):bool
    {
        if ($model->load($post)) {

          if ($model->validate()){
            return true;
        }


    }
    return false;
}

}