<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1 class="contact-title"><?= Html::encode($this->title) ?></h1>
</div>

<div class="wrap-contact">
    <div class="contact-row">
        <div class="contact__item contact-address">
            <div class="contact-address__item">
                <p class="contact-address__label">адрес:</p>
                <p class="contact-address__val">г. Пермь, ул. Мира 41в, ТЦ Арктик Холл</p>
            </div>
            <div class="contact-address__item">
                <p class="contact-address__label">телефоны:</p>
                <div class="contact-address__val">
                    <?= Html::img("@web/images/icon/social/call.svg", ['class' => 'header__telephone-icon'], ["alt" => 'tel']) ?>
                    <a href="tel:+79082751477">
                        <p class="header__telephone-num">8 908 275 14 77</p>
                    </a>
                </div>
                <div class="contact-address__val">
                    <?= Html::img("@web/images/icon/social/call.svg", ['class' => 'header__telephone-icon'], ["alt" => 'tel']) ?>
                    <a href="tel:+79655519771">
                        <p class="header__telephone-num">8 965 551 97 71</p>
                    </a>
                </div>
            </div>
            <div class="contact-address__item">
                <p class="contact-address__label">Напишите нам :</p>
                <div class="contact-address__val">
                    <p class="write-us__text">whatsapp</p>
                    <?= Html::a(Html::img("@web/images/icon/social/whatsapp.svg", ['class' => 'write-us__icon'], ["alt" => 'tel']), Url::to('https://wapp.click/79082751477')) ?>
                </div>
                <div class="contact-address__val">
                    <p class="write-us__text">viber</p>
                    <?= Html::a(Html::img("@web/images/icon/social/viber.svg", ['class' => 'write-us__icon'], ["alt" => 'tel']), Url::to('https://viber.click/79082751477')) ?>
                </div>
            </div>
            <div class="contact-address__item">
                <p class="contact-address__label">email:</p>
                <p class="contact-address__val"><?= Html::mailto('mail@albanna.ru', 'mail@albanna.ru') ?></p>
            </div>
        </div>
        <div class="contact__item">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'body')->textarea(['rows' => '6']) ?>

            <?= $form->field($model, 'reCaptcha')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha2::className(),
                [
                    'siteKey' => '6Lc3iyUaAAAAAFM06W3c7OaE8-KqKqF3TsYCmT39', // unnecessary is reCaptcha component was set up
                ]
            ) ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>

    <div class="cantact-map">
        <h2 class="contact-map__title">Мы на крате</h2>
        <div class="cantact-map__wrap">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A739b8083270322616364a294df86f01d8df58ed7f578b30755d4b78a989fc56e&amp;max-width=920&amp;height=720&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
    </div>


</div>