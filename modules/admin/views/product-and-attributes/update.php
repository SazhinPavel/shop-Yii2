<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductAndAttributes */

$this->title = 'Update Product And Attributes: ' . $model->id_product;
$this->params['breadcrumbs'][] = ['label' => 'Product And Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_product, 'url' => ['view', 'id_product' => $model->id_product, 'attribut_value' => $model->attribut_value]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-and-attributes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
