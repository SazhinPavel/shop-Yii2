<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AttributesProduct */

$this->title = 'Update Attributes Product: ' . $model->attr_name;
$this->params['breadcrumbs'][] = ['label' => 'Attributes Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->attr_name, 'url' => ['view', 'attr_name' => $model->attr_name, 'attr_value' => $model->attr_value]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attributes-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
