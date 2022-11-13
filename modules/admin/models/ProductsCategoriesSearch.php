<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\ProductsCategories;

/**
 * ProductsCategoriesSearch represents the model behind the search form of `app\modules\admin\models\ProductsCategories`.
 */
class ProductsCategoriesSearch extends ProductsCategories
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categories', 'id_products'], 'integer'],
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
        $query = ProductsCategories::find();

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
            'id_categories' => $this->id_categories,
            'id_products' => $this->id_products,
        ]);

        return $dataProvider;
    }
}
