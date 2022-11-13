<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductsCategories */

//$this->title = 'Создать связь продукта и категории';
$this->params['breadcrumbs'][] = ['label' => 'Продукты и категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>