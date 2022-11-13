<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить товар', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $img = $model->getImage();
    $images = $model->getImages();
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            // 'category_id',
            [
                'attribute' => 'category_id',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return  $data->category->title;
                }
            ],
            'categoriesasstring',
            'content:html',
            'art',
            // 'stock',
            [
                'attribute' => 'stock',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return !$data->stock == 1 ? '<span class = "text-danger">под заказ</span>'  : '<span class = "text-success">в наличии</span>';
                },
                'format' => 'html'
            ],
            'price',
            'old_price',
            'alias',
            // 'img',
            [
                'attribute' => 'image',
                'value' => "<img class='prod-img' src = '{$img->getUrl()}' >",
                'format' => 'html'
            ],
            [
                'attribute' => 'gallery',
                'value' => function ($data) {
                    $images =  $data->getImages();
                    $arr  = '';
                    foreach ($images as $key => $img) {
                        if ($key == 0)  $arr .=  "<img class='prod-img prod-img-mainfoto' src = '{$img->getUrl()}' >";
                        else $arr .=  "<img class='prod-img' src = '{$img->getUrl()}' >";
                    }
                    return $arr;
                },
                'format' => 'html'
            ],

            [
                'attribute' => 'hit',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return !$data->hit == 1 ? '<span class = "text-danger">нет</span>'  : '<span class = "text-success">да</span>';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'new',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return !$data->new == 1 ? '<span class = "text-danger">нет</span>'  : '<span class = "text-success">да</span>';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'sale',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return !$data->sale == 1 ? '<span class = "text-danger">нет</span>'  : '<span class = "text-success">да</span>';
                },
                'format' => 'html'
            ],
        ],
    ]) ?>


</div>