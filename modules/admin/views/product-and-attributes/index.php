<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product And Attributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-and-attributes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product And Attributes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id_product',
            [
                'attribute' => 'parent_id',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return $data->product->title;
                }
            ],
            'attribut_value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>