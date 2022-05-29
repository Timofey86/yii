<?php

namespace app\components;

use yii\base\Component;
use yii\db\ActiveRecord;

class MySqlStorageComponent extends Component implements StorageInterface
{
    /** @param \yii\db\ActiveRecord $model
     * @return integer
     */


    public function add(ActiveRecord $model)
    {
        $model->save(false);
        return $model->id;
    }

    public function get(ActiveRecord $model, $id)
    {
        return $model::find()->where(['id' => $id])->one();
    }

    public function getList(ActiveRecord $model, $options = [])
    {
        return $model::find()->all();
    }
}