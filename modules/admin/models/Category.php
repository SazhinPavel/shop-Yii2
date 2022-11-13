<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $title
 * @property int|null $parent_id
 * @property int|null $sort_index
 *
 * @property Products[] $products
 * @property ProductsCategories[] $productsCategories
 * @property Products[] $products0
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_id', 'sort_index'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ номер категории',
            'title' => 'Название',
            'parent_id' => 'Родительская категория',
            'sort_index' => 'Порядок вывода категорий',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getProducts()
    // {
    //     return $this->hasMany(Products::className(), ['category_id' => 'id']);
    // }


    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[ProductsCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getProductsCategories()
    // {
    //     return $this->hasMany(ProductsCategories::className(), ['id_categories' => 'id']);
    // }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getProducts0()
    // {
    //     return $this->hasMany(Products::className(), ['id' => 'id_products'])->viaTable('products_categories', ['id_categories' => 'id']);
    // }
}
