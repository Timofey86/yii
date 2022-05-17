<?php

namespace app\components;

use app\models\Activity;
use yii\base\Component;
use yii\db\Exception;
use yii\web\UploadedFile;
use function Composer\Autoload\includeFile;

class ActivityComponent extends Component
{
    public $model_class;

    public function init()
    {
        parent::init();

        if (empty($this->model_class)) {
            throw new \Exception('Need model_class param');
        }
    }


    public function getModel()
    {
        return new $this->model_class;
    }

    /* @var Activity $model */
    public function createActivity(&$model, $post): bool
    {
        if ($model->load($post) && $model->validate()) {
            $model->images = UploadedFile::getInstances($model, 'images');
            if ($this->loadImages($model)) {
                return true;
            }
        }
        /*            if(!empty($file = $comp->saveUploadedFile($model->file))) {
                        $model->file=basename($file);

                    }*/
        return false;
    }


    public function loadImages($model)
    {
        $component = \Yii::createObject(['class' => FileServiseComponent::class]);
        foreach ($model->images as &$image) {
            if ($file = $component->saveUploadedFile($image)) {
                $image = basename($file);
            }

        }
        return true;
    }
}