<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Session;

/**
 * Sessionsearch represents the model behind the search form of `common\models\Session`.
 */
class Sessionsearch extends Session
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userID', 'year'], 'integer'],
            [['sessionid', 'username', 'role', 'college', 'prog_or_dept', 'sessiontime'], 'safe'],
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
        $query = Session::find();

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
            'userID' => $this->userID,
            'year' => $this->year,
            'sessiontime' => $this->sessiontime,
        ]);

        $query->andFilterWhere(['like', 'sessionid', $this->sessionid])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'college', $this->college])
            ->andFilterWhere(['like', 'prog_or_dept', $this->prog_or_dept]);

        return $dataProvider;
    }
}
