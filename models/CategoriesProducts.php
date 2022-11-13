<?php

namespace app\models;

use app\modules\admin\models\Products;
use Yii;

/**
 * This is the model class for table "products_categories".
 *
 * @property int $id_categories
 * @property int $id_products
 */
class CategoriesProducts extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_categories' => 'Id Categories',
            'id_products' => 'Id Products',
        ];
    }
    // название должно соответсвовать with
    public function getProduct()
    {
        return $this->hasMany(Products::class, ['id' => 'id_products']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'id_categories']);
    }
}
