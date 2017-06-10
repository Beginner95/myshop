<?php

namespace app\modules\client\controllers;

use app\modules\client\models\Cart;
use app\models\Product;
use app\modules\client\models\Client;
use app\modules\client\models\Delivery;
use app\modules\client\models\OrderClient;
use app\modules\client\models\OrderItemsClient;
use app\modules\client\models\Payment;
use Yii;

class CartController extends AppClientController
{
    public function actionAdd() {
        $id = Yii::$app->request->get('id');
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));

    }
    
    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem() {
        $id = Yii::$app->request->get('id');
        $session =Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));

    }

    public function actionShow()
    {
        $session =Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');
        $order = new OrderClient();


        if ($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            $order->client_id = Yii::$app->user->identity->id;

            if ($order->save()) {
                $this->setBalance($order->sum, $order->id);
                $this->saveOrderItemsClient($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер вскоре свяжется с Вами.');

                Yii::$app->mailer->compose('order', ['session' => $session])
                    ->setFrom(['test@mail.ru' => 'MyShop'])
                    ->setTo($order->email)
                    ->setSubject('Заказ')
                    ->send();
                
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка оформления заказа.');
            }
        }

        $delivery = Delivery::find()->all();
        $fio = [
            'firstName' => Yii::$app->user->identity->firstName,
            'secondName' => Yii::$app->user->identity->secondName,
            'lastName' => Yii::$app->user->identity->lastName,
            'email' => Yii::$app->user->identity->email,
            'phone' => Yii::$app->user->identity->phone,
            'address' => Yii::$app->user->identity->address,
        ];
        return $this->render('view', compact('session', 'order', 'fio', 'delivery'));
    }

    protected function saveOrderItemsClient($items, $order_id)
    {
        foreach ($items as $id => $item) {
            $order_items = new OrderItemsClient();
            $order_items->order_client_id = $order_id;
            $order_items->product_id = $id;
            $order_items->client_id = Yii::$app->user->identity->id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();
        }
    }
    
    protected function setBalance($sum, $order_id)
    {
        $payment = new Payment();
        $payment->client_id = Yii::$app->user->identity->id;
        $payment->order_client_id = $order_id;
        $payment->amount = $this->getBalance()['amount'] - $sum;
        $payment->description = 'Оплата заказа ' . $order_id;
        $payment->save();
    }

    protected function getBalance()
    {
        return Payment::find()
            ->select(['amount'])
            ->where(['client_id' => Yii::$app->user->identity->id])
            ->asArray()
            ->orderBy('id DESC')
            ->one();
    }
}