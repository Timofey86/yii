<?php

namespace app\components;

use yii\db\ActiveRecord;

interface StorageInterface
{
    public function add(ActiveRecord $model);

    public function get(ActiveRecord $model, $id);

    public function getList(ActiveRecord $model, $options = []);

}