<?php

use yii\helpers\Url;
?>
<li class="catalog__link ">
    <a class="<?php if ($category["parent_id"] == 0) echo " category__main";
                else  echo " catalog__chaild";
                if (isset($category['childs'])) echo ' catalog__parent ';
                // if ($category["parent_id"] == 0) echo ' category__main' 
                ?>" href="<?= Url::to(['category/view', 'id' => $category['id']]) ?>">
        <?= $category['title'] ?>
        <?php if (isset($category['childs'])) : ?>
            <span></span>
        <?php endif; ?>
    </a>
    <?php if (isset($category['childs'])) : ?>
        <ul class="<?php echo 'catalog-list__chaild' ?>">
            <?= $this->getMenuHtml($category['childs']) ?>
        </ul>
    <?php endif; ?>
</li>