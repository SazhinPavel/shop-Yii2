<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\OrderTable */

$this->title = 'Create Order Table';
$this->params['breadcrumbs'][] = ['label' => 'Order Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-table-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
