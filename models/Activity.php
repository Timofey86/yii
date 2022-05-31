<?php

namespace app\models;

use app\base\BaseModel;
use app\behaviors\DateCreatedBehavior;
use app\behaviors\LogMeBehavior;
use app\models\rules\NotAdminRule;
use yii\helpers\ArrayHelper;


class Activity extends ActivityBase
{

    public $images;

    public function behaviors()
    {
        return [
            ['class' => DateCreatedBehavior::class,
                'attribute_name' => 'date_add'],
            LogMeBehavior::class
        ];
    }

    /*  public function beforeValidate()
      {
          if ($this->date_start) {
              $date = \DateTime::createFromFormat('d.m.Y', $this->date_start);
              if ($date) {
                  $this->date_start = $date->format('Y-m-d');
              }
          }
          return parent::beforeValidate();
      }*/

    public function rules()
    {
        return array_merge([
            [['title', 'date_start',], 'required'],
            [['title', 'description', 'email'], 'trim'],
            ['description', 'string', 'max' => 250],
            [['date_start', 'date_end'], 'date', 'format' => 'php:Y-m-d'],
            ['email', 'email'],
//            ['title', 'match', 'pattern' => '/w+{10,}/'],
            /*['repeat_email', 'compare', 'compareAttribute' => 'email',
                'message' => 'Значения email должны быть равны'],*/
            ['email', 'required', 'when' => function ($model) {
                return $model->use_notification == 1 ? true : false;
            }],
            ['images', 'file', 'extensions' => ['jpg', 'png'], 'maxFiles' => 4],
//          ['title','notAdmin'],
            /*[['title', 'description'], NotAdminRule::class,],*/
            [['is_blocked', 'use_notification'], 'boolean'],
            ['repeat_type_id', 'in', 'range' => array_keys(static::getRepeatTypes())]
        ], parent::rules());
    }

    /*    public function notAdmin($attr)
        {
            if ($this->title == 'admin') {
                $this->addError('title', 'Загаловок не должен быть admin');
            }
        }*/

    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'use_notification' => 'Уведомление о событие',
            'description' => 'Описание',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'is_blocked' => 'Блокирующее событие',
            'repeat_type_id' => 'Повтор',
            'images' => 'Картинки'
        ];
    }

    public function getRepeatTypes()
    {
        static $repeat_types;
        if (!isset($repeat_types)) {
            $repeat_types = ActivityRepeatType::find()->asArray()->all();
            $repeat_types = ArrayHelper::map($repeat_types, 'id', 'name');
        }
        return $repeat_types;
    }

    /*  public function getRepeatTypeName($id){
          $data = $this->getRepeatTypes();
          return array_key_exists($id,$data) ? $data[$id] : false;
      }*/

    public function fields()
    {
        return [
            'id', 'title', 'user_id', 'date_start',
            'user_email' => function ($model) {
                return $model->user->email;
            }
        ];
    }

    public function extraFields()
    {
        return [
            'email', 'date_add'
        ];
    }

}