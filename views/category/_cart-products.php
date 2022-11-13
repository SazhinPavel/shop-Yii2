<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>


<?php foreach (isset($products->product) ? $products->product : $products   as  $product) : ?>
  <div class="product-cart product-cart_catalog">

    <?php $img = $product->getImage(); ?>

    <div class="product__link-img"><?= Html::img($img->getUrl('175x'), ['alt' => "{$product['title']}", 'title' => "{$this->title}"]) ?></div>

    <p class="product__title">
      <?= Html::a($product['title'], Url::to(['/product/view', 'id' => $product['id']])) ?>

    </p>
    <?php if (!$product['old_price'] == 0) : ?>
      <p class="product__price product__price-cross"><?= $product['old_price'] ?></p>
    <?php endif; ?>
    <p class="product__price"><?= $product['price'] ?> ₽</p>

    <a class="button-link product__button" data-id=<?= $product['id'] ?> href="#">В корзину</a>
  </div>
<?php endforeach; ?>