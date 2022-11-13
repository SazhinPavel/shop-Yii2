<?php


use app\assets\AppBasic;
use yii\helpers\Html;


AppBasic::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?></title>
    <?php
    // $this->registerCsrfMetaTags() можно отключть если в котролере отключен параметр, выдает временный токен для пост запросов 
    ?>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>


    <div class="container">
        <nav class="nav">
            <?= Html::a('Главная', 'http://localhost/albanna/albanna/web/index.php') ?>
            <?= Html::a('Статьи', ['category/index']) ?>
            <?= Html::a('Статья', ['post/show']) ?>
            <?= Html::a('Тест', ['post/test']) ?>
        </nav>
    </div>





    <?= $content ?>
    <?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>