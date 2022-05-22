<?php

namespace app\models;

use yii\data\ActiveDataProvider;

class ActivitySearch extends Activity
{
    public function getDataProvider($params)
    {
        $model = new Activity();
        $query = $model::find();

        $this->load($params);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>[
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]

        ]);

        $query->andFilterWhere(['like','email',$this->email]);
        $query->with('user');

        return $provider;
    }

}