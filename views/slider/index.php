<?php


$this->registerJsFile(
    '@web/js/sliderPrice.js',
    [
        'depends' => 'yii\web\YiiAsset', // зависимости для скрипта
        'position' => $this::POS_END    // подключать в <head>
    ]
);


?>

<style>
    .bar {
        padding: 50px;

    }

    #r-slder {
        margin: 50px;
    }
</style>


<div class="container">
    <div class="bar">
        <div id="r-slider"></div>
        <!-- <input id="input-format" type="text"> -->
    </div>
    <div class="bar flex">
        <div id="reset" class="btn">Сбросить</div>
    </div>
</div>