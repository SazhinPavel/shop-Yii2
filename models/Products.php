<?php

namespace app\models;

use yii\db\ActiveRecord;

class Products extends ActiveRecord
{


    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    public static function tableName()
    {
        //переименовываем таблицу
        return 'products';
    }

    public function getCategories()
    {

        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getProductAndAttributes()
    {
        return $this->hasMany(ProductAndAttributes::class, ['id_product' => 'id']);
    }

    public function getProductsFromCategories()
    {

        return $this->hasMany(CategoriesProducts::class, ['id_products' => 'id']);
    }

    public static function getProductFromCategories($id, $sort = null)
    {
        if ($sort == 'price-low') {
            return  $query =  self::find()->innerJoinWith('productsFromCategories')->where(['id_categories' => $id])->orderBy(['products.price' => SORT_ASC]);
        } elseif ($sort == 'price-hight') {
            return   $query =  self::find()->innerJoinWith('productsFromCategories')->where(['id_categories' => $id])->orderBy(['products.price' => SORT_DESC]);
        } else {
            //    SELECT * FROM `products` inner JOIN products_categories on products.id = products_categories.id_products WHERE products_categories.id_categories = 4
            return  $query = self::find()->innerJoinWith('productsFromCategories')->where(['id_categories' => $id]);
        }
    }

    public static function getMaxPrice($id)
    {
        return self::find()->innerJoinWith('productsFromCategories')->where(['id_categories' => $id])->max('price');
    }

    public static function getMinPrice($id)
    {
        return self::find()->innerJoinWith('productsFromCategories')->where(['id_categories' => $id])->min('price');
    }
}
