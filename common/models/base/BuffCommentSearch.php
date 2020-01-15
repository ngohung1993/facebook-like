<?php

namespace common\models\base;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BuffComment;

/**
 * BuffCommentSearch represents the model behind the search form of `common\models\BuffComment`.
 */
class BuffCommentSearch extends BuffComment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'comment_total', 'commented', 'speed'], 'integer'],
            [['post_id', 'content'], 'safe'],
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
        $query = BuffComment::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'comment_total' => $this->comment_total,
            'commented' => $this->commented,
            'speed' => $this->speed,
        ]);

        $query->andFilterWhere(['like', 'post_id', $this->post_id])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
