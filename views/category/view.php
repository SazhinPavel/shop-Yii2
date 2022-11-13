<?php

/* @var $this yii\web\View */

use app\components\MenuWidget;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\widgets\LinkPager;



// $this->registerJsFile(
//     '@web/js/sliderPrice.js',
//     [
//         'depends' => 'yii\web\YiiAsset', // зависимости для скрипта
//         'position' => $this::POS_END    // подключать в <head>
//     ]
// );


$this->params['breadcrumbs'][] = [
    'label' => 'Каталог',
    'url' => Url::to('/category/products')
];



$countBreads = count($breadCrumbs);
foreach ($breadCrumbs as $id =>  $item) {
    if ($countBreads == 1) {
        $this->title = $item;
        $this->params['breadcrumbs'][] =  $item;
    } else {
        $this->params['breadcrumbs'][] = [
            'label' => $item,
            'url' => Url::to("/category/" . $id)
        ];
    }
    $countBreads--;
}


?>

<div class="wrap-content">



    <div class="container">
        <h1 class="main-title-catalog"><?php Html::encode($this->title) ?></h1>
    </div>


    <div class="wrap-catalog">

        <div class="btn-catalog">
            <?php // echo Html::img('@web/images/icon/menu-category.svg', ['alt' => 'меню категорий', 'class' => 'btn-catalog__icon'])
            ?>
        </div>


        <ul class="wrap-catalog__item catalog ac ac--animation">

            <?= MenuWidget::widget(['tpl' => 'menu']) ?>

        </ul>

        <?php
        ?>

        <div class="wrap-catalog__item product-wrap">

            <div itemprop="offers" itemscope itemtype="https://schema.org/AggregateOffer">
                <meta itemprop="offerCount" content="<?= $count ?>">
                <meta itemprop="lowPrice" content="<?= $minPrice ?>">
                <meta itemprop="highPrice" content="<?= $maxPrice ?>">
                <meta itemprop="priceCurrency" content="RUB">
            </div>

            <h2 class="title-product"><?= array_pop($breadCrumbs) ?></h2>
            <div class="filter">
                <p class="filter__goods-count">Товаров: <?= $count ?></p>
                <div class="filter__title">
                    Сортировать по цене:
                </div>
                <div class="filter__list">
                    <div class="filter__item">
                        <a class="filter__link filter__link_up" href="<?php echo  Url::to(['category/view', 'id' => $id, 'sort' => 'price-low']) ?>">Минимальная цена <?= $minPrice ?> RUB</a>
                    </div>
                    <div class="filter__item">
                        <a class="filter__link filter__link_down" href="<?php echo Url::to(['category/view', 'id' => $id, 'sort' => 'price-hight']) ?>">Максимальная цена <?= $maxPrice ?> RUB</a>
                    </div>

                </div>
            </div>

            <?php
            ?>
            <hr class="title-line">

            <div class="product-row">
                <?php if (!empty($products)) : ?>

                    <?php echo $this->render('_cart-products',  [
                        'products' => $products,
                    ]) ?>

            </div>
        <?php else : ?>
            <h2>Нет товара</h2>
        <?php endif; ?>
        <div class="pagination_products">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ])

            ?>
        </div>
        </div>

    </div>

</div>