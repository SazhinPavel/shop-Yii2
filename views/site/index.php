<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\helpers\Url;

$this->title = 'Главная страница';

// debug($productsHit);
// die;

?>


<div class="main-screen">
    <div class="main-screen__overlay">
        <div class="wrapper">
            <div class="title-wrap g-row">
                <div class="title col-5">
                    <h1 class="title__h1">Кокосовый уголь качества премиум</h1>
                    <ul class="title__items">
                        <li class="title__item">Тлеет более 2 часов</li>
                        <li class="title__item">Не содержит серы</li>
                        <li class="title__item">10 мундштуков в подарок</li>
                        <li class="title__item">1 кг за 499 рублей</li>
                    </ul>
                    <?= Html::a('Уголь для кальяна >', Url::to('category/4'), ['class' => 'button-link']) ?>

                    <div class="header__telepnone">
                        <p class="header__telepnone-text">Принимаем заказы по телефонам:</p>
                        <div>
                            <div class="header__telepnone-wrap">
                                <?= Html::img("@web/images/icon/social/call.svg", ['class' => 'header__telephone-icon'], ["alt" => 'tel']) ?>
                                <a href="tel:+79082751477">
                                    <p class="header__telephone-num">8 908 275 14 77</p>
                                </a>
                            </div>
                            <div class="header__telepnone-wrap">
                                <?= Html::img("@web/images/icon/social/call.svg", ['class' => 'header__telephone-icon'], ["alt" => 'tel']) ?>
                                <a href="tel:+79655519771">
                                    <p class="header__telephone-num">8 965 551 97 71</p>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="header__telepnone">
                        <p class="header__telepnone-text">Напишите нам в мессенджерах :</p>
                        <div>
                            <div class="button-messenger">

                                <a class="button-messenger__link" href="viber://chat?number=79082751477">
                                    viber
                                </a>
                            </div>
                            <div class="button-messenger">
                                <a class="button-messenger__link" href="whatsapp://send/?phone=79082751477">
                                    whatsapp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-screen__img-container col-7"><?= Html::img("images/main/albanna.jpg", ['class' => 'main-screen__img', 'alt' => 'уголь Albanna']) ?></div>
            </div>
        </div>
    </div>
</div>
<div class="product-wrap">
    <?php if (!empty($productsCoal)) : ?>
        <h2 class="title-product">Уголь для кальяна</h2>
        <hr class="title-line">
        <div class="product-row">
            <?php echo $this->render('_cart-products',  [
                'products' => $productsCoal,
            ]) ?>
        </div>
    <?php endif; ?>
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