<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AttributesProduct */

$this->title = $model->attr_name;
$this->params['breadcrumbs'][] = ['label' => 'Attributes Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="attributes-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'attr_name' => $model->attr_name, 'attr_value' => $model->attr_value], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'attr_name' => $model->attr_name, 'attr_value' => $model->attr_value], [
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
            'attr_name',
            'attr_value',
        ],
    ]) ?>

</div>
