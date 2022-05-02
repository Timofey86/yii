<?php

namespace app\models\rules;

use yii\validators\Validator;

class NotAdminRule extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if ($model->$attribute == 'admin'){
            $model->addError($attribute,'Загаловок не должен быть admin');
        }
    }

}