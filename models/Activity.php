<?php

namespace app\models;

use app\base\BaseModel;
use app\models\rules\NotAdminRule;


class Activity extends BaseModel
{
    public $title;
    public $description;
    public $date_start;
    public $repeat_type;
    public $is_blocked;
    public $email;
    public $repeat_email;
    public $use_notification;
    public $images;
    public $date_end;


    protected static $repeat_types = [
        0 => 'Без повтора',
        1 => 'Ежедневно',
        2 => 'Еженедельно',
        3 => 'Ежемесячно',
        4 => 'Ежегодно',
    ];

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
        return [
            [['title', 'date_start',], 'required'],
            [['title', 'description','email'], 'trim'],
            ['description', 'string', 'max' => 250],
            [['date_start','date_end'], 'date', 'format' => 'php:Y-m-d'],
            ['email', 'email'],
//            ['title', 'match', 'pattern' => '/w+{10,}/'],
            /*['repeat_email', 'compare', 'compareAttribute' => 'email',
                'message' => 'Значения email должны быть равны'],*/
            ['email', 'required', 'when' => function ($model) {
                return $model->use_notification == 1 ? true : false;
            }],
            ['images', 'file', 'extensions' => ['jpg', 'png'],'maxFiles' => 4],
//          ['title','notAdmin'],
            /*[['title', 'description'], NotAdminRule::class,],*/
            [['is_blocked', 'use_notification'], 'boolean'],
            ['repeat_type', 'in', 'range' => array_keys(self::$repeat_types)]
        ];
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
            'title' => 'Название активности',
            'use_notification' => 'Уведомление о событие',
            'description' => 'Описание',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата окончания',
            'is_blocked' => 'Блокирующее событие',
            'repeat_type' => 'Повтор',
            'repeat_email' => 'Повтор Email',
            'images' => 'Картинки'
        ];
    }

    public function getRepeatTypes()
    {
        return array_merge(static::$repeat_types,);
    }

    public function getRepeatType($id){
        $data = $this->getRepeatTypes();
        return array_key_exists($id,$data) ? $data[$id] : false;
    }

}