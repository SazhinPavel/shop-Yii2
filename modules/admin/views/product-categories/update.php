<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductsCategories */

$this->title = 'Update Products Categories: ' . $model->id_categories;
$this->params['breadcrumbs'][] = ['label' => 'Products Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_categories, 'url' => ['view', 'id_categories' => $model->id_categories, 'id_products' => $model->id_products]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-categories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
