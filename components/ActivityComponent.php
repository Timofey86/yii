<?php

namespace app\components;

use app\behaviors\LogMeBehavior;
use app\models\Activity;
use yii\base\Component;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;


class ActivityComponent extends Component
{
    public $model_class;

    const EVENT_LOAD_IMAGES= 'load_images';

    public function behaviors()
    {
        return [
            LogMeBehavior::class
        ];
    }

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

    /**
     * @throws \yii\base\InvalidConfigException
     */
    protected function insert($model)
    {
        $record = $this->getModel();
        $record->setAttributes($model->attributes);
        if ($record->save()) {
            return $record->id;
        }
        return false;
    }

    /* @var Activity $model */
    public function createActivity(&$model, $post): bool
    {
        if ($model->load($post)) {
            $model->images = UploadedFile::getInstances($model, 'images');
            $model->user_id = \Yii::$app->user->identity->getId();
            if ($model->validate()) {
                if ($this->loadImages($model)) {
                    if ($id = $model->save($model)) {
                        return $id;
                    }
                }
            }
        }

        return false;
    }

    /*            if(!empty($file = $comp->saveUploadedFile($model->file))) {
                    $model->file=basename($file);

                }*/


    public function loadImages($model)
    {
        $component = \Yii::createObject(['class' => FileServiseComponent::class]);
        foreach ($model->images as &$image) {
            if ($file = $component->saveUploadedFile($image)) {
                //$this->on(self::EVENT_LOAD_IMAGES,func);
                $this->trigger(self::EVENT_LOAD_IMAGES);
                $image = basename($file);
            }

        }
        return true;
    }

    public function getActivity($id)
    {
        $model = $this->getModel();
        $model = $model::findOne(['id' => $id]);
        return $model;

    }

    /**
     * @param $from
     * @return mixed
     */
    public function getActivityFroNotification($from)
    {
        $record =  $this->getModel();
        return $record::find()->andWhere('date_start>=:from',[':from'=>$from])
            ->andWhere(['use_notification' => 1])->andWhere('date_start<=:to',[':to' => date('Y-m-d').'24:00:00'])
            //->createCommand()->rawSql;
            ->asArray()->all();

    }


}