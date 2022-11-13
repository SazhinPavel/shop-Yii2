<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $this->title = 'Таблица категорий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            // 'parent_id',
            [
                'attribute' => 'parent_id',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return isset($data->category->title) ? $data->category->title : 'Самостоятельная категория';
                }
            ],
            // 'sort_index',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>