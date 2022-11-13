<?php

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
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
        return 'categories';
    }

    //связываем таблицы
    public  function getProducts()
    {
        // 1 парам имя класса с которым связывам 
        // первый ключ - это поле из этой же таблицы
        // второй ключ это таблица из текущей модели
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }



    public static function breadCrumbs($array, $id)
    {


        $count = count($array);
        $breadcrumbs_array = array();
        for ($i = 0; $i < $count; $i++) {
            if ($id) {
                $breadcrumbs_array[$array[$id]['id']] = $array[$id]['title'];
                $id = (int) $array[$id]['parent_id'];
            }
        }


        return $breadcrumbs_array;
    }
}
