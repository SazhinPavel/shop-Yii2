<?php

use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ProductsSSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-s-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php echo $form->field($model, 'id')
    ?>

    <?php echo  $form->field($model, 'title')
    ?>

    <?php // echo  $form->field($model, 'content')
    ?>

    <?php // echo  $form->field($model, 'category_id')
    ?>

    <?php echo $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'), [
        'prompt' => ''
    ]);
    ?>

    <?php // echo  $form->field($model, 'art')
    ?>

    <?php // echo $form->field($model, 'stock')
    ?>

    <?php // echo $form->field($model, 'price')
    ?>

    <?php // echo $form->field($model, 'old_price')
    ?>

    <?php // echo $form->field($model, 'alias')
    ?>

    <?php // echo $form->field($model, 'img')
    ?>

    <?php // echo $form->field($model, 'hit')
    ?>

    <?php // echo $form->field($model, 'new')
    ?>

    <?php // echo $form->field($model, 'sale')
    ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск товара', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сбросить настройки', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>