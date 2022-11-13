<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<ul class="admin-list">
    <li><?= Html::a('Продукты', '/admin/products', ['class' => 'admin-list__item']) ?></li>
    <li><?= Html::a('Категории', '/admin/product-categories', ['class' => 'admin-list__item']) ?></li>
    <li><?= Html::a('Заказы', '/admin/ordertable', ['class' => 'admin-list__item']) ?></li>
</ul>
</div>