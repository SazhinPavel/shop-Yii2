<?php

use app\components\MenuWidget;
use app\models\Category;
use app\modules\admin\models\ProductsCategories;
use mihaildev\ckeditor\CKEditor;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Products */
/* @var $form yii\widgets\ActiveForm */

// debug($model);
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'categories_array')->widget(Select2::class, [
        'data' => ArrayHelper::map(Category::find()->select(['id', 'title'])->all(), 'id', 'title'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбрать категорию', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
            'tags' => true
        ],
    ]);

    ?>

    <?php // echo $form->field($model, 'category_id')->textInput() 
    ?>

    <?php // echo $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'));
    ?>

    <div class="form-group field-products-category_id required has-success">
        <label class="control-label" for="products-category_id">Category ID</label>
        <select id="products-category_id" class="form-control" name="Products[category_id]" aria-required="true" aria-invalid="false">
            <?= MenuWidget::widget(['tpl' => 'select_product', 'model' => $model]) ?>
        </select>
    </div>

    <?php // $form->field($model, 'content')->textInput(['maxlength' => true]) 
    ?>

    <?php
    echo $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);
    ?>

    <?php
    $img = $model->getImage();
    $images = $model->getImages();
    // debug($img->itemId);
    // die;
    ?>

    <?= $form->field($model, 'art')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'old_price')->textInput() ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>


    <?php if ($img->getUrl()) : ?>
        <img width="250" src="<?= $img->getUrl() ?>" alt="">
    <?php endif; ?>

    <?php echo $form->field($model, 'image')->fileInput()
    ?>


    <?php echo $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])
    ?>

    <?php if (count($images) > 1) : ?>
        <?php foreach ($images as $img) : ?>
            <img width="100" src="<?= $img->getUrl() ?>" alt="">
        <?php endforeach; ?>
        <button class="deleteAll-Img" data-img="<?= $img->itemId ?>">Удалить все фото</button>
    <?php endif; ?>


    <?= $form->field($model, 'hit')->checkbox(['0', '1']) ?>

    <?= $form->field($model, 'new')->checkbox(['0', '1'])  ?>

    <?= $form->field($model, 'sale')->checkbox(['0', '1'])  ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>