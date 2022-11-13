<?php

namespace app\controllers;


use app\controllers\AppController;
use app\models\Cart;
use app\models\OrderItem;
use app\models\OrderTable;
use app\modules\admin\models\Products;
use Codeception\Test\Loader;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\Url;

class CartController extends AppController
{


    public function actionAdd()
    {

        $id = Yii::$app->request->get('id');
        if (empty($id))  return $this->render('cart-modal', compact('session'));
        $qty = (int) Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Products::findOne($id);
        if (empty($product)) return false;
        // создаем объект сессии
        $session = Yii::$app->session;
        // открывем сессию
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        //проверка если пришло не ajax
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        //убираем подключение шаблона
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionIndex()
    {
        // создаем объект сессии
        $session = Yii::$app->session;
        // открывем сессию
        $session->open();
        //заголовок страницы
        $this->setMeta('Корзина');
        $order = new OrderTable();
        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят, менеджер вскоре свяжется с Вами');

                if (!empty($order->email)) {
                    Yii::$app->mailer->compose('client', ['session' => $session])
                        ->setFrom('order@albanna.ru')
                        ->setTo($order->email)
                        ->setSubject('Ваш заказ на Albanna.ru')
                        ->send();
                }

                $this->orderAdmin($order, $session);
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('erorr', 'Ошибка оформления заказа');
            }
        }
        return $this->render('index', compact('session', 'order'));
    }

    public function actionDeleteItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDeleteItemPage()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
    }

    protected function saveOrderItems($items, $order_id)
    {
        foreach ($items as $id => $item) {
            $order_items = new OrderItem();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['title'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['price'] *  $item['qty'];
            $order_items->save();
        }
    }

    public function actionAddQty()
    {

        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->plusModal($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDeleteQty()
    {

        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->minusModal($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionAddQtyOrder()
    {

        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->plusModal($id);
        $this->layout = false;
        return $this->render('cart-order', compact('session'));
    }


    public function actionDeleteQtyOrder()
    {

        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->minusModal($id);
        $this->layout = false;
        return $this->render('cart-order', compact('session'));
    }

    public function actionCheckCart()
    {
        $session = Yii::$app->session;
        // открывем сессию
        $session->open();
        if ($session['cart.qty']) {
            $qty = $session['cart.qty'];
        } else {
            $qty = '0';
        }

        $html = Html::a($qty, Url::to('/cart/index'));
        return   $qty;
    }

    public function actionGetCart()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function orderAdmin($order, $session)
    {
        Yii::$app->mailer->compose('admin', ['session' => $session, 'mail' => $order->email, 'name' => $order->name, 'phone' => $order->phone])
            ->setFrom('order@albanna.ru')
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject('Новый заказ на Albanna.ru')
            ->send();
    }
}
