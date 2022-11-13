<?php

namespace app\models;

use yii\db\ActiveRecord;


class Cart extends ActiveRecord
{

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }


    public function addToCart($product, $qty = 1)
    {
        $img = $product->getImage();

        // проверяем наличии сессии
        //попробовать к переменной $sesssion обратиться
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] = $_SESSION['cart'][$product->id]['qty'] + $qty;
        } else {
            // создаем сессию
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'title' => $product->title,
                'price' => $product->price,
                'img' =>   $img->getUrl('100x')
            ];
        }

        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;
    }

    public function recalc($id)
    {
        if (!isset($_SESSION['cart'][$id])) return false;
        $qtyMinus =  $_SESSION['cart'][$id]['qty'];
        $qtySum =   $_SESSION['cart'][$id]['qty'] *  $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty'] -=  $qtyMinus;
        $_SESSION['cart.sum']  -=  $qtySum;
        unset($_SESSION['cart'][$id]);
    }

    public function plusModal($id)
    {
        if (!isset($_SESSION['cart'][$id])) return false;
        $_SESSION['cart'][$id]['qty'] = $_SESSION['cart'][$id]['qty'] + 1;
        $_SESSION['cart.qty'] = $_SESSION['cart.qty']  + 1;
        $_SESSION['cart.sum']  =  $_SESSION['cart.sum']  + $_SESSION['cart'][$id]['price'];
    }
    public function minusModal($id)
    {
        if (!isset($_SESSION['cart'][$id])) return false;
        if ($_SESSION['cart'][$id]['qty'] == 1) return false;
        $_SESSION['cart'][$id]['qty'] = $_SESSION['cart'][$id]['qty'] - 1;
        $_SESSION['cart.qty'] = $_SESSION['cart.qty']  - 1;
        $_SESSION['cart.sum']  =  $_SESSION['cart.sum']  - $_SESSION['cart'][$id]['price'];
    }
}
