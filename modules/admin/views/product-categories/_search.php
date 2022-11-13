<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductsCategoriesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-categories-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_categories') ?>

    <?= $form->field($model, 'id_products') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти связь', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить настройки', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>