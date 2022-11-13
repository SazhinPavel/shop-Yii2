<?php

//подключаем стили и скрипты
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

//подключаем стили и скрипты
AppAsset::register($this);
$this->registerCssFile('@web/css/admin-style.css');

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админка: <?= $this->title ?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="header-wrap">
        <div class="header">
            <div class="logo">
                <div class="logo__img-wrap">
                    <?= Html::a(Html::img("@web/images/icon/logo.svg", ["alt" => 'Logo'], ['class' => 'logo__img']), URL::to('/'), ['class' => 'nav__item']) ?>

                </div>
            </div>
            <nav class="nav">
                <?= Html::a('Кальяны', URL::to(['/category/view', 'id' => 1]), ['class' => 'nav__item']) ?>
                <?= Html::a('Табак', URL::to(['/category/view', 'id' => 2]), ['class' => 'nav__item']) ?>
                <?= Html::a('Акссесуары', URL::to(['/category/view', 'id' => 3]), ['class' => 'nav__item']) ?>
                <?= Html::a('Контакты', URL::to('/site/contact'), ['class' => 'nav__item']) ?>
            </nav>
            <form class="form-inline mt-2 mt-md-0" method="get" action="<?= Url::to(['category/search']) ?>">
                <input class="form-control mr-sm-2" type="text" placeholder="search" name="q">
            </form>
            <div class="cart">
                <a href="<?= Url::to(['/site/logout']) ?>">выход</a>
            </div>
        </div>
    </div>

    <div class="wrap-breadcrumbs">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => 'Главная админки',
                'url' => '/admin/products/',
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumb']
        ]) ?>
        <?= Alert::widget() ?>

    </div>
    <div class="wrapper-content">
        <ul class="admin-list">
            <li><?= Html::a('Продукты', '/admin/products', ['class' => 'admin-list__item']) ?></li>
            <li><?= Html::a('Продукт/категория', '/admin/product-categories', ['class' => 'admin-list__item']) ?></li>
            <li><?= Html::a('Категории', '/admin/category/index', ['class' => 'admin-list__item']) ?></li>
            <li><?= Html::a('Заказы', '/admin/ordertable', ['class' => 'admin-list__item']) ?></li>
        </ul>
        <div class="container-table">
            <?= $content ?>
        </div>

    </div>



    </div>




    <?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>