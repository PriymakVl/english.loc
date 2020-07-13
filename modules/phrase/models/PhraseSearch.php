<?php

namespace app\modules\phrase\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\phrase\models\Phrase;

class PhraseSearch extends Phrase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'text_id', 'status'], 'integer'],
            [['engl', 'ru'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $where['status'] = STATUS_ACTIVE;
        if (isset($params['text_id'])) $where['text_id'] = $params['text_id'];
        $query = Phrase::find()->where($where);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['text_id' => $this->text_id]);

        // grid filtering conditions
        $query->andFilterWhere(['like', 'engl', $this->engl])
            ->andFilterWhere(['like', 'ru', $this->ru]);

        return $dataProvider;
    }
}
