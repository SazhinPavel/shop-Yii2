<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;

?>


<?php
// debug($model);
?>


<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <?php echo Yii::$app->session->getFlash('error'); ?>
<?php endif; ?>

<div class="container">
    <h1>Статьи</h1> <!-- в begin можно передавать Sопции, можно поменять action и метод отправки -->
    <!-- создается объект формы -->
    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'id' => 'testForm']]) ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'date')->widget(DatePicker::class) ?>
    <?= $form->field($model, 'text')->textarea(['rows' => 5]) ?>
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    <?php $form = ActiveForm::end() ?>
</div>