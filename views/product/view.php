<?php

use app\components\MenuWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;


$this->registerCssFile('@web/js/magnific-popup/css/magnific-popup.css');
$this->registerCssFile('@web/lib/slick/css-slick/slick.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);
$this->registerCssFile('@web/lib/slick/css-slick/slick-theme.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);
$this->registerCssFile('@web/css/product.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);
$this->registerCssFile('@web/css/slider-slick.css', ['depends' => ['yii\bootstrap\BootstrapAsset']]);

$this->registerJsFile(
    '@web/js/magnific-popup/js/jquery.magnific-popup.min.js',
    [
        'depends' => 'yii\web\YiiAsset', // зависимости для скрипта
        'position' => $this::POS_END    // подключать в <head>
    ]
);

$this->registerJsFile(
    '@web/js/magnific-popup.js',
    [
        'depends' => 'yii\web\YiiAsset', // зависимости для скрипта
        'position' => $this::POS_END    // подключать в <head>
    ]
);


$this->registerJsFile(
    '@web/js/slider-slick.js',
    [
        'depends' => 'yii\web\YiiAsset', // зависимости для скрипта
        'position' => $this::POS_READY    // подключать в <head>
    ]
);

$this->params['breadcrumbs'][] = [
    'label' => 'Каталог',
    'url' => Url::to('/category/products')
];

$count = count($breadCrumbs);
if ($count == 1) {
    foreach ($breadCrumbs as $id =>  $item) { {
            $this->params['breadcrumbs'][] = [
                'label' => $item,
                'url' => Url::to("/category/" . $id)
            ];
        }
    }
} else {
    foreach ($breadCrumbs as $id =>  $item) {
        if ($count == 1) {
            $this->params['breadcrumbs'][] =  $item;
        } else {
            $this->params['breadcrumbs'][] = [
                'label' => $item,
                'url' => Url::to('/category/' . $id)
            ];
        }
    }
}

$this->title = $product->title;
$this->params['breadcrumbs'][] = $product->title;

$img = $product->getImage();
$images = $product->getImages();

?>
<div class="wrap-content">
    <div class="wrap-catalog">
        <ul class="wrap-catalog__item catalog ac ac--animation">
            <?= MenuWidget::widget(['tpl' => 'menu']) ?>
        </ul>
        <div itemscope itemtype="http://schema.org/Product" class="wrapper-product">
            <h1 itemprop="name" class="product-title-page"><?= $product->title ?></h1>
            <div class="photo">

                <div class="photo__main">
                    <?php if (count($images) > 1) : ?>
                        <div class="slider-big">
                            <?php foreach ($images as $img) : ?>
                                <div class="slider-big__item popup-gallery">
                                    <?= Html::a(Html::img($img->getUrl(), ['alt' =>  $product->title, 'itemprop' => 'image']), [$img->getUrl()]) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <?= Html::a(Html::img($img->getUrl(), ['alt' =>  $product->title, 'itemprop' => 'image']), [$img->getUrl()], ['class' => 'image-popup-no-margins']) ?>
                    <?php endif; ?>
                </div>
                <div class="photo__main_small">
                    <?php if (count($images) > 1) : ?>
                        <div class="slider-small">
                            <?php foreach ($images as $img) : ?>
                                <div class="slider-small__item">
                                    <?= Html::img($img->getUrl('150x'), ['alt' => "{$product->title}", 'title' => "{$this->title}", 'itemprop' => 'image']) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
            <div class="info">
                <div itemprop="description" class="out-content"><?= $product->content ?></div>
                <?php //if (array_key_exists('attr_name', $product[0])) :
                ?>
                <ul class="product-card-spec__list">
                    <?php // for ($i = 0; $i < count($product); $i++) :
                    ?>
                    <!-- <li class="product-card-spec__item">
                        <div class="product-card-spec__title">
                            <?php // $product[$i]->attribut['attr_name']
                            ?>
                        </div>
                        <div class="product-card-spec__value">
                            <?php // $product[$i]->attribut['attr_value']
                            ?>
                        </div>
                    </li> -->
                    <?php // endfor;
                    ?>
                </ul>
                <?php //endif;
                ?>

                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price">
                    <?php // if (!$product['old_price'] == 0) :
                    ?>
                    <!-- <p class="product__price product__price-cross"><?php // $product->old_price
                                                                        ?></p> -->
                    <?php //endif;
                    ?>
                    <p itemprop="price" class="price__value"><?= $product->price ?><span itemprop="priceCurrency"> RUB</span></p>
                    <a class="button-link product__button" data-id='<?= $product->id ?>' href="#">В корзину</a>
                </div>
            </div>

        </div>
    </div>
</div>