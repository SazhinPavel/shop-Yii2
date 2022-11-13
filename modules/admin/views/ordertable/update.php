<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OrderTable */

$this->title = 'Update Order Table: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Order Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-table-update">

    <h1><?= 'Редактирование заказа: ' . $model->id ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>