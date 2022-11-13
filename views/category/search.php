<?php

use app\components\MenuWidget;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->params['breadcrumbs'][] = [
    'label' => 'Каталог',
    'url' => Url::to('/category/products')
];

$this->params['breadcrumbs'][] = 'Поиск по названию: ' . Html::encode($q);


?>

<?php if (empty($products)) : ?>
    <!-- html::encode убираем вывод кода -->
    <h2 class="product-title">Ничего не найдено по слову: "<?= Html::encode($q)  ?>"</h2>
<?php else : ?>
    <h2 class="product-title">Поиск по запросу: "<?= Html::encode($q) ?>"</h2>
<?php endif; ?>
<div class="container">
    <div class="wrap-catalog">
        <ul class="catalog">
            <?= MenuWidget::widget(['tpl' => 'menu']) ?>
        </ul>

        <div class="product-wrap">
            <div class="product-row">
                <?php if (!empty($products)) : ?>

                    <?php foreach ($products as  $product) : ?>
                        <div class="product-cart product-cart_catalog">
                            <!-- Вывод иконок -->
                            <?php if ($product['hit'] == 1) : ?>

                                <div class="info-img">
                                    <?= Html::img("@web/images/main/hit.svg", ["alt" => 'Хит продаж']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($product['sale'] == 1) : ?>
                                <div class="info-img info-img_sale">
                                    <?= Html::img("@web/images/main/sale.svg", ["alt" => 'Распродажа']) ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($product['new'] == 1) : ?>
                                <div class="info-img info-img_new">
                                    <?= Html::img("@web/images/main/new.svg", ["alt" => 'Хит продаж']) ?>
                                </div>
                            <?php endif; ?>
                            <!-- конец вывода иконок -->
                            <?php $img = $product->getImage(); ?>


                            <div class="product__link-img"><?= Html::img(["{$img->getUrl()}"]) ?></div>

                            <p class="product__title">
                                <?= Html::a($product['title'], Url::to(['/product/view', 'id' => $product['id']])) ?>

                            </p>


                            <?php if (!$product['old_price'] == 0) : ?>
                                <p class="product__price product__price-cross"><?= $product['old_price'] ?></p>
                            <?php endif; ?>
                            <p class="product__price"><?= $product['price'] ?></p>

                            <a class="button-link product__button" data-id=<?= $product['id'] ?> href="#">Добавить</a>
                        </div>

                    <?php endforeach; ?>



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