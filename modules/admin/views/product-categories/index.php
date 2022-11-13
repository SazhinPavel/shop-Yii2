<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Создание связи продукта с категорией';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php Pjax::begin([
            'enablePushState' => false
        ]);
        ?>
        <?php echo  Html::a('Создать связь', ['create'], ['class' => 'btn btn-success'])
        ?>
        <?php Pjax::end();
        ?>
    </p>
    <h2>Поиск:</h2>
    <?php echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <?php Pjax::begin([]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_categories',
            [
                'attribute' => 'id_categories',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return  $data->categories->title;
                }
            ],
            'id_products',
            [
                'attribute' => 'Название продукта',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return $data->products->title;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>