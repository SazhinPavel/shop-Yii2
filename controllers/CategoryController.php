<?php

namespace app\controllers;

use app\models\Category;
use Yii;
use yii\data\Pagination;
use app\models\Products;
use yii\web\HttpException;


class CategoryController extends AppController

{

    public function actionProducts()
    {
        $query = Products::find();
        $sort = Yii::$app->request->get('sort');
        if ($sort == 'price-low') {
            $query =  Products::find()->orderBy(['price' => SORT_ASC]);
        } elseif ($sort == 'price-hight') {
            $query =  Products::find()->orderBy(['price' => SORT_DESC]);
        } else {
            $query = Products::find();
        }
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count, 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('products', compact('products', 'pages', 'count'));
    }


    public function actionTest()
    {
        $id = (int) Yii::$app->request->get('id');
        $query = Products::find()->innerJoinWith('categoriesproduct')->where(['categories.id'])->all();
    }


    public function actionView()
    {
        $id = (int) Yii::$app->request->get('id');
        $sort = Yii::$app->request->get('sort');
        if (!$id) throw new HttpException(404, 'Такой категории не существует');
        /**
         * получаем массив для хлебных крошек
         */
        $get_array =  Category::find()->indexBy('id')->asArray()->all();
        $breadCrumbs_array  = Category::breadCrumbs($get_array, $id);
        $breadCrumbs = array_reverse($breadCrumbs_array, true);

        $query = Products::getProductFromCategories($id, $sort);

        $maxPrice = Products::getMaxPrice($id);
        $minPrice = Products::getMinPrice($id);

        $count = $query->count();
        // создаем объект пагинации, pageSize - сколько выводим
        $pages = new Pagination(['totalCount' =>  $count, 'pageSize' => 12]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('view', compact('products', 'pages', 'breadCrumbs', 'id', 'count', 'maxPrice', 'minPrice'));
    }

    public function actionSearch()
    {
        $q = Yii::$app->request->get('q');
        $this->setMeta("Albanna | Поиск " . $q);
        $query = Products::find()->where(['like', 'title', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'q'));
    }
}
