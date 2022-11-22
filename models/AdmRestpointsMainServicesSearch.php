<?php

namespace app\admin\models;

/**
 * AdmRestpointsMainServicesSearch represents the model behind the search form about `app\admin\models\AdmRestpointsMainServices`.
 */
class AdmRestpointsMainServicesSearch extends AdmRestpointsMainServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restpoint', 'main_services'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @return array
     */
    public function search($params)
    {
        $result = [];
        $query = AdmRestpointsMainServices::find();

        // add conditions that should always apply here

        $this->load([(new \ReflectionClass($this))->getShortName() => $params]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $result;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'restpoint' => $this->restpoint,
            'main_services' => $this->main_services,
        ]);
        $result = $query->asArray()->all();

        return $result;
    }
}

