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

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?></title>
    <meta name="Description" content="Оптово-розничная продажа кальянов, табака и аксессуаров." />
    <meta name="yandex-verification" content="49ffce0285307f4a" />
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="header-wrap header-wrap_white">
        <div class=" header-first">
            <p class="header-first__adress">г. Пермь ул. Мира 41в, тц Арктик Холл</p>
            <p class="header-first__descriptor">
                Оптово-розничная продажа кальянов, табака и аксессуаров
            </p>
            <div class="header__telepnone-wrap">
                <?= Html::img("@web/images/icon/social/call.svg", ['class' => 'header__telephone-icon'], ["alt" => 'tel']) ?>
                <a href="tel:+79655519771">
                    <p class="header__telephone-num">8 965 551 97 71</p>
                </a>
            </div>
        </div>
    </div>

    <div class="header-wrap">
        <div class="header">
            <div class="header__item header-logo">
                <?= Html::a(Html::img("@web/images/icon/logo.svg", ["alt" => 'Logo'], ['class' => 'logo__img']), URL::to('/'), ['class' => 'nav__item']) ?>
            </div>
            <div class="header__item menu">
                <nav class="nav">
                    <?= Html::a('Кальяны', URL::to(['/category/view', 'id' => 28]), ['class' => 'nav__item']) ?>
                    <?= Html::a('Табак', URL::to(['/category/view', 'id' => 2]), ['class' => 'nav__item']) ?>
                    <?= Html::a('Акссесуары', URL::to(['/category/view', 'id' => 51]), ['class' => 'nav__item']) ?>
                    <?= Html::a('Уголь для кальяна', URL::to(['/category/view', 'id' => 4]), ['class' => 'nav__item']) ?>
                    <?= Html::a('Бонги', URL::to(['/category/view', 'id' => 5]), ['class' => 'nav__item']) ?>

                    <?= Html::a('Контакты', URL::to('/site/contact'), ['class' => 'nav__item']) ?>
                </nav>
                <!-- <form class="form-inline  header-search" method="get" action="<?php // Url::to(['category/search'])
                                                                                    ?>">
                    <input class="form-control" type="text" placeholder="search" name="q">
                </form> -->

            </div>

            <div class="cart-wrap">
                <div class="cart">
                    <div class="cart__qty"></div>
                    <div class="cart__img">
                        <?= Html::img("@web/images/icon/shopping-cart.svg", ["alt" => 'cart'], ['class' => 'cart__img']) ?>
                    </div>
                </div>
            </div>

            <div class="header__burger"><span></span></div>
        </div>
    </div>

    <div class="wrap-breadcrumbs">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumb']
        ]) ?>
        <?= Alert::widget() ?>
    </div>


    <?= $content ?>

    <div class="footer-wrap">
        <div class="footer">
            <div class="footer__item logo">
                <div class="logo__img-wrap">
                    <?= Html::a(Html::img("@web/images/icon/logo.svg", ["alt" => 'Logo'], ['class' => 'logo__img']), URL::to('/'), ['class' => 'nav__item']) ?>

                </div>
            </div>

            <div class="footer__item text-danger">
                Мы не продаем табак и аксессуары лицам младше 18 лет <br>
                <p> МИНЗДРАВ предупреждает, курение вредит Вашему здоровью</p>
            </div>
            <div class="footer__item  social-link">
                <?= Html::a(Html::img("@web/images/icon/social/vk-draw-logo.svg", ["alt" => 'vk']), URL::to('https://vk.com/hookah_perm_al_banna'), ['class' => 'social-link__item']) ?>

                <?= Html::a(Html::img("@web/images/icon/social/instagram-draw-logo.svg", ["alt" => 'vk']), URL::to('https://www.instagram.com/al_banna_perm/'), ['class' => 'social-link__item']) ?>

            </div>
            <span style="color: black">vk:08264</span>
        </div>
    </div>

    <?php

    Modal::begin([
        'header' => '<h2 style = "text-align: center;">18+</h2>',
        'id' => '18',
        'size' => 'modal-lg',
        'footer' => '
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Продолжить</button>'
    ]);

    echo '
    Данный сайт содержит информацию о табачной продукции. Продолжая пользоваться сайтом, вы подтверждаете, что ваш возраст старше 18 лет.';

    Modal::end();

    ?>

    <?php Modal::begin([
        'header' => '<h2>Ваша корзина</h2>',
        'id' => 'cart',
        'size' => 'modal-lg',
        'footer' => '
        <button type="button" class="btn btn-secondary modal-btn__item" data-dismiss="modal">Продолжить покупки</button>
        <a href =" ' . Url::to(['cart/index']) . ' " class="btn btn-primary modal-btn__item"><span>Оформить заказ</span></a>
        '
    ]);
    // <button type="button" class="btn btn-danger modal-btn__item" onclick = clearCart()>Очистить корзину</button>
    Modal::end();
    ?>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(73305286, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/73305286" style="position:absolute; left:-9999px;" alt="" /></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
    <?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>