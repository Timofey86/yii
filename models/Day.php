<?php

namespace app\models;

use app\base\BaseModel;

class Day extends BaseModel
{
    public $type;
    public $activities;

    protected static $types = [
        0 => 'Рабочий',
        1 => 'Выходной',
    ];

    public function rules()
    {
        return ['type','in', 'range' => array_keys($this->getTypes())];
    }

    public function getTypes()
    {
        return static::$types;
    }

}