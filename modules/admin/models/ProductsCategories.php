<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "products_categories".
 *
 * @property int $id_categories
 * @property int $id_products
 *
 * @property Products $products
 * @property Categories $categories
 */
class ProductsCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categories', 'id_products'], 'required'],
            [['id_categories', 'id_products'], 'integer'],
            [['id_categories', 'id_products'], 'unique', 'targetAttribute' => ['id_categories', 'id_products']],
            [['id_products'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['id_products' => 'id']],
            [['id_categories'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_categories' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_categories' => 'Категория',
            'id_products' => 'Id Продукта',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id' => 'id_products']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_categories']);
    }
}
