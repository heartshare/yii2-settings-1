<?php

namespace dizews\settings\models\search;

use dizews\settings\models\Setting;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class SettingSearch extends Setting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'key'], 'safe'],
            [['type', 'category', 'key'], 'string', 'max' => 255],
            [['created_at', 'updated_at', 'value_string'], 'safe'],
            [['is_active'], 'integer']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Setting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'is_active' => $this->is_active
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value_string', $this->value_string])
            ->andFilterWhere(['like', 'created_at', $this->created_at.'%', false]);

        return $dataProvider;
    }
}
