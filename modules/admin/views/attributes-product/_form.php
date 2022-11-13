<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AttributesProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attributes-product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'attr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'attr_value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
