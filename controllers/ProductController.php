<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\ProductAndAttributes;
use app\modules\admin\models\Products;
use Yii;
use yii\helpers\VarDumper;
use yii\web\HttpException;

class ProductController extends AppController
{



    public function actionView()
    {
        $id = (int) Yii::$app->request->get('id');
        if (!$id) throw new HttpException(404, 'Такой категории не существует');

        // $product = Product::find()->select('id, title, img, price, attr_name, attr_value, category_id, old_price')->innerJoin('product_and_attributes', 'product_and_attributes.id_product=products.id')->innerJoin('attributes_product', 'product_and_attributes.attribut_value=attributes_product.attr_value')->where(['products.id' => $id])->asArray()->all();

        // $product = ProductAndAttributes::find($id)->innerJoinWith("product")->innerJoinWith("attribut")->where(['id_product' => $id])->all();

        $product = Products::findOne(['id' => $id]);
        if (!isset($product)) throw new HttpException(404, 'Товар не найден');

        // for ($i = 0; $i < count($product); $i++) {
        //     debug($product[$i]->attribut['attr_name']);
        // }


        //если у товара нет описания
        if ($product) {
            $cat  = $product->category_id;
        }
        // else {
        //     $product = Product::find()->where(['id' => $id])->asArray()->all();
        //     $cat = $product->category_id;
        // }



        $get_array =  Category::find()->indexBy('id')->asArray()->all();
        $category  = new Category();
        $breadCrumbs_array  = $category->breadCrumbs($get_array, $cat);
        $breadCrumbs = array_reverse($breadCrumbs_array, true);



        return $this->render('view', compact('product', 'breadCrumbs', 'id'));
    }
}
