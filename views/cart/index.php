 <?php

    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;

    $this->params['breadcrumbs'][] = [
        'label' => 'Каталог',
        'url' => Url::to('/category/products')
    ];
    $this->params['breadcrumbs'][] = 'Корзина';

    ?>

 <div class="container-cart">
     <h1><?= Html::encode($this->title) ?></h1>


     <?php if (Yii::$app->session->hasFlash('success')) : ?>
         <!-- <div class="alert alert-success" role="alert">
             <?php // Yii::$app->session->getFlash('success')
                ?>
         </div> -->
     <?php endif; ?>

     <?php if (Yii::$app->session->hasFlash('error')) : ?>
         <!-- <div class="alert alert-danger" role="alert">
             <?php // Yii::$app->session->getFlash('error')
                ?>
         </div> -->
     <?php endif; ?>

     <?php if (!empty($session['cart'])) : ?>

         <div class="table-responsive">
             <table class="table table-hover table-striped">
                 <thead>
                     <tr>
                         <th>Фото</th>
                         <th>Наименование</th>
                         <th>Количество</th>
                         <th>Цена</th>
                         <th>Сумма</th>
                         <th>Удалить</th>

                     </tr>
                 </thead>
                 <tbody>
                     <?php foreach ($session['cart'] as $id => $item) : ?>
                         <tr>
                             <td>
                                 <?= Html::img(["{$item['img']}"], ['alt' => $item['title'], 'height' => 100]) ?>
                             </td>
                             <td><a href="<?= Url::to(["product/view", 'id' => $id]) ?>"><?= $item['title'] ?></a></td>
                             <td>
                                 <span class="minus" data-id="<?= $id ?>">
                                     <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                         <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                     </svg>
                                 </span>
                                 <?= $item['qty'] ?><span class="plus" data-id="<?= $id ?>">
                                     <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                         <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                         <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                     </svg>
                                 </span>
                             </td>
                             <td><?= $item['price'] ?></td>
                             <td><?= $item['qty']  *  $item['price'] ?></td>
                             <td class="del-item" data-id="<?= $id ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                     <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                     <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                 </svg></td>
                         </tr>
                     <?php endforeach; ?>
                     <tr>
                         <td colspan="5">Количество:</td>
                         <td><?= $session['cart.qty'] ?></td>
                     </tr>
                     <tr>
                         <td colspan="5">Сумма:</td>
                         <td><?= $session['cart.sum'] ?></td>
                     </tr>
                 </tbody>
             </table>
         </div>
         <h2>Форма заказа</h2>
         <hr>
         <?php $form = ActiveForm::begin(); ?>
         <?= $form->field($order, 'name'); ?>
         <?= $form->field($order, 'email'); ?>
         <?= $form->field($order, 'phone'); ?>

         <?php // echo $form->field($order, 'address');
            ?>
         <?= Html::submitButton("заказать", ['class' => 'btn btn-success']); ?>
         <?php $form = ActiveForm::end(); ?>

     <?php else : ?>
         <h3 class="cart__empty-title">Корзина пуста</h3>
         <p class="cart__empty-subtitle">Перейти в <?= Html::a('каталог', '/category/products') ?> </p>
     <?php endif; ?>
 </div>