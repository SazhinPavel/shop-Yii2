<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductAndAttributes */

$this->title = $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Product And Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-and-attributes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_product' => $model->id_product, 'attribut_value' => $model->attribut_value], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_product' => $model->id_product, 'attribut_value' => $model->attribut_value], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_product',
            [
                'attribute' => 'parent_id',
                'value' => function ($data) {
                    // получаем из связи в модели
                    return $data->product->title;
                }
            ],
            'attribut_value',
        ],
    ]) ?>

</div>