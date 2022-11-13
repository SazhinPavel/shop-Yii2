<?php

use app\models\Product;
use app\modules\admin\models\AttributesProduct;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductAndAttributes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-and-attributes-form">

    <?php $form = ActiveForm::begin(['method' => 'post']); ?>

    <?php // $form->field($model, 'id_product')->textInput() 
    ?>

    <?php echo $form->field($model, 'id_product')->dropDownList(ArrayHelper::map(Product::find()->all(), 'id', 'title'));
    ?>

    <?php echo $form->field($model, 'attribut_value')->dropDownList(ArrayHelper::map(AttributesProduct::find()->all(), 'attr_value', 'attr_value'));
    ?>

    <?php // $form->field($model, 'attribut_value')->textInput(['maxlength' => true]) 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>