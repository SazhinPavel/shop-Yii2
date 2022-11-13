<?php

use app\models\Category;
use app\modules\admin\models\Products;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductsCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'id_categories')->textInput() 
    ?>
    <?php echo $form->field($model, 'id_categories')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'));
    ?>

    <?php // echo $form->field($model, 'id_products')->dropDownList(ArrayHelper::map(Products::find()->all(), 'id', 'title'));
    ?>

    <?php echo $form->field($model, 'id_products')->textInput()
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>