<?php

use app\modules\admin\models\Category;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Products;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Таблица продуктов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <h2 style="margin: 60px 0 20px;">Вывод товаров</h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            // 'category_id',
            [
                'attribute' => 'category_id',
                'filter' => Category::find()->select(['title', 'id'])->indexBy('id')->column(),
                'value' => 'category.title'
            ],
            // 'art',
            // 'stock',
            // [
            //     'attribute' => 'stock',
            //     'value' => function ($data) {
            //         // получаем из связи в модели
            //         return !$data->stock == 1 ? '<span class = "text-danger">под заказ</span>'  : '<span class = "text-success">в наличии</span>';
            //     },
            //     'format' => 'html'
            // ],
            // 'price',
            //'old_price',
            // 'alias',
            // 'img',
            // 'hit',
            // [
            //     'attribute' => 'hit',
            //     'value' => function ($data) {
            //         // получаем из связи в модели
            //         return !$data->hit == 1 ? '<span class = "text-danger">нет</span>'  : '<span class = "text-success">да</span>';
            //     },
            //     'format' => 'html'
            // ],

            [
              'attribute' => 'Находится в категориях', 
              //'filter' => Category::find()->select(['title', 'id'])->indexBy('id')->column(),
              'value' => function (Products $products){
                return implode(', ', ArrayHelper::map($products->categories, 'id', 'title'));
              }
            ],

            // 'new',
            // 'sale',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>





</div>