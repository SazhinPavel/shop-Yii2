<?php

/* @var $this yii\web\View */

use app\components\MenuWidget;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = 'Каталог';
?>
<div class="wrap-content">
    <h1><?php // Html::encode($this->title)
        ?></h1>
    <div class="wrap-catalog">
        <ul class="catalog ac ac--animation">
            <li></li>
            <?= MenuWidget::widget(['tpl' => 'menu']) ?>
        </ul>

        <div class="product-wrap">
            <h2 class="title-product">Каталог</h2>

            <div class="filter">
                <p class="filter__goods-count">Товаров: <?= $count ?></p>
                <div class="filter__title">
                    Сортировать:
                </div>
                <div class="filter__list">
                    <div class="filter__item">
                        <a class="filter__link filter__link_up" href="<?= Url::to(['category/products', 'sort' => 'price-low']) ?>">По цене</a>
                    </div>
                    <div class="filter__item">
                        <a class="filter__link filter__link_down" href="<?= Url::to(['category/products', 'sort' => 'price-hight']) ?>">По цене</a>
                    </div>
                    <!-- <div class="filter__item">
                        <a class="filter__link" href="#">Популярные</a>
                    </div> -->
                </div>
            </div>
            <hr class="title-line">
            <div class="product-row">
                <?php if (!empty($products)) : ?>

                    <?php echo $this->render('_cart-products',  [
                        'products' => $products,
                    ]) ?>
                <?php else : ?>
                    <h2>Нет товара</h2>
                <?php endif; ?>
            </div>
            <div class="pagination_products">
                <?= LinkPager::widget([
                    'pagination' => $pages,
                ])
                ?>
            </div>
        </div>
    </div>
</div>