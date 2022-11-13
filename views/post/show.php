<?php

use app\components\MyWidget;
use yii\jui\DatePicker;

// $this->title = "Одна статья"; // можно дать заголовок странице
// $this->registerJSFile('@web/js/script.js');  // Подключение скрипта из вида
// $this->registerJSFile('@web/js/script.js', ['depends'] = >  'yii\web\YiiAsset');  
// Подключение c зависимостью
// $this -> registerJS('');  // подключаем отдельный код, можно обернуть выполнение при загрузки


// $script = <<< JS
// $('#btn').on('click', function(e) {
//     $.ajax({
//        url: 'index.php?r=post/index',
//        data: {'test': "123"},
//        type:'POST',
//         success: function(data) {
//           console.log(data)
//        },
//        error:
//        function(){
//            alert("Error!");
//        }
//     });
// });
// JS;

// $this->registerJs($script);
// where $position can be View::POS_READY (the default), 
// or View::POS_HEAD, View::POS_BEGIN, View::POS_END
?>
<?php MyWidget::begin() ?>
<h1>Привет, мир!</h1>

<?php MyWidget::end() ?>



<?php
// // debug($cats[0]->products);
// echo '<ul>';
// foreach ($cats as $cat) {
//     echo '<li>' . $cat->title . '</li>';
//     $products = $cat->products;
//     echo '<ul>';
//     foreach ($products as $product) {

//         echo '<li>' . $product->title . '</li>';
//     }
//     echo '<ul>';
// }
// echo '</ul>';
?>

<!-- <button class="btn btn-success" id="btn">Click me...</button> -->