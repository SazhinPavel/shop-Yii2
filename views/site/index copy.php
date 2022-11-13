<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'Главная страница';

// debug($productsHit);
// die;

?>


<div class="main-screen">
    <div class="title-wrap">
        <!-- <div class="delivery">
            <div class="delivery__icon"><img src="images/icon/free-delivery.svg" alt=""></div>
            <p class="delivery__text">Бесплатная доставка по городу от 1000 ₽</p>
        </div> -->
        <h1 class="main-title">Оптовая продажа кальянов, табачных изделий и аксессуаров в Перми</h1>
        <?= Html::a('Продукция >', Url::to('category/products'), ['class' => 'button-link']) ?>
    </div>

</div>


<div class="catalog-wrap">

    <div class="catalog-link-row">
        <div class="catalog-link__items catalog-link__items_k">
            <?= Html::a('Кальяны >', Url::to(['category/view', 'id' => 28]), ['class' => 'button-link catalog-link']) ?>
        </div>
        <div class="catalog-link__items catalog-link__items_t">
            <?= Html::a('Табак >', Url::to(['category/view', 'id' => 2]), ['class' => 'button-link catalog-link']) ?>
        </div>
        <div class="catalog-link__items catalog-link__items_a">
            <?= Html::a('Аксессуары >', Url::to(['category/view', 'id' => 51]), ['class' => 'button-link catalog-link']) ?>
        </div>
    </div>

</div>


<div class="product-wrap">

    <?php if (!empty($productsSale)) : ?>
        <h2 class="title-product">Акция</h2>
        <hr class="title-line">
        <div class="product-row">
            <?php echo $this->render('_cart-products',  [
                'products' => $productsSale,
            ]) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($productsHit)) : ?>
        <h2 class="title-product">Популярные товары</h2>
        <hr class="title-line">
        <div class="product-row">
            <?php echo $this->render('_cart-products',  [
                'products' => $productsHit,
            ]) ?>
        </div>
    <?php endif; ?>
</div>
<?php if (!empty($productsNew)) : ?>
    <div class="new-section">
        <div class="catalog-wrap_new">
            <h2 class="title-product title-product-grey">Новиники</h2>
            <hr class="title-line">
            <div class="product-row">
                <?php echo $this->render('_cart-products',  [
                    'products' => $productsNew,
                ]) ?>
            </div>
        </div>
    </div>
<?php endif; ?>