<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Products */

$this->registerJsFile(
    '@web/js/admin.js',
    [
        'depends' => 'yii\web\YiiAsset', // зависимости для скрипта
        'position' => $this::POS_END    // подключать в <head>
    ]
);

$this->title = 'Редактировать товар: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>