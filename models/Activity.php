<?php

namespace app\models;

use app\base\BaseModel;


class Activity extends BaseModel
{
    public $title;
    public $description;
    public $date_start;
    public $repeat_type;
    public $is_blocked;

    protected static $repeat_types = [
        0 => 'Без повтора',
        1 => 'Ежедневно',
        2 => 'Еженедельно',
        3 => 'Ежемесячно',
        4 => 'Ежегодно',
    ];

    public function rules()
    {
        return [
            ['title', 'required'],
            ['description','string','min' => 10, 'max' => 150],
            ['date_start','date','format' => 'php:Y-m-d'],
            ['is_blocked','boolean'],
            ['repeat_type','in', 'range' => array_keys(self::$repeat_types)]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название активности',
            'description' => 'Описание',
            'date_start' => 'Дата начала',
            'is_blocked' => 'Блокирующее событие',
            'repeat_type' => 'Повтор'
        ];
    }

    public function getRepeatTypes()
    {
        return array_merge(static::$repeat_types,);//[5 => 'Недопустимо']
    }

}