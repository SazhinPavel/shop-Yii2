<?php

namespace app\controllers;

use app\models\CategoriesProducts;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;

class SliderController extends AppController
{
    public function actionIndex()
    {
        // $this->view->registerJsFile('@web/css/nouislider.css');
        // $this->view->registerCssFile('@web/js/nouislider.min.js');
        return $this->render('index');
    }
}
