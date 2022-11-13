<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductsSSearch represents the model behind the search form of `app\modules\admin\models\ProductsS`.
 */
class ProductSearch extends Products
{

  public $cat_tag; // добавить в правило что появилась фильтрация

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'stock', 'price', 'old_price', 'category_id', 'hit', 'new', 'sale'], 'integer'],
            [['title', 'content', 'art', 'alias'], 'safe'],
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
        $query = Products::find()->with(['category', 'categories']);
        // если нужна ффильтрация по тегам категорий
       // $query = Products::find()->with(['category', 'categories'])->joinWith(['categories'], false);
        //$query = self::find()->innerJoinWith('productsFromCategories')->where(['id_categories' => $id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
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
            'category_id' => $this->category_id,
            'stock' => $this->stock,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'hit' => $this->hit,
            'new' => $this->new,
            'sale' => $this->sale,
           'products_categories.id_categories' => $this->cat_tag
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            //->andFilterWhere(['like', 'category_id', $this->category_id])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'art', $this->art])
            ->andFilterWhere(['like', 'alias', $this->alias]);


        return $dataProvider;
    }
}
