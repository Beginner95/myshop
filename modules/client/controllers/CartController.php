<?php

namespace app\modules\client\controllers;

use app\models\Order;
use app\modules\client\models\Cart;
use app\modules\client\models\Product;
use app\modules\client\models\Delivery;
use app\modules\client\models\OrderClient;
use app\modules\client\models\OrderItemsClient;
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

            $cost = Delivery::find()
                ->select(['cost'])
                ->where(['id' => (int)Yii::$app->request->post()['OrderClient']['delivery_id']])
                ->one();

            $items = OrderClient::find()
                ->select('id, date_added')
                ->all();
            foreach ($items as $item) {
                if (OrderClientController::getDate($item->date_added) == date('d-m-Y')) {
                    return $this->updateOrder($item->id);
                }
            }

            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'] * ((100 - Yii::$app->user->identity->discount) / 100) + $cost->cost;
            $order->client_id = Yii::$app->user->identity->id;

            if ($order->save()) {
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

    protected function updateOrder($id)
    {
        $session = Yii::$app->session;
        $session->open();

        $order = OrderClient::findOne(['id' => $id]);
        $order->status = '0';
        $order->qty += $session['cart.qty'];
        $order->sum += $session['cart.sum'] * ((100 - Yii::$app->user->identity->discount) / 100);

        if ($order->save()) {
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

        }
        return $this->refresh();
    }

    protected function saveOrderItemsClient($items, $order_id)
    {
        foreach ($items as $id => $item) {
            $model = OrderItemsClient::findOne(['product_id' => $id]);
            if (null !== $model) {
                $model->qty_item += $item['qty'];
                $model->sum_item += $item['qty'] * $item['price'] * ((100 - Yii::$app->user->identity->discount) / 100);
                $model->save();
            } else {
                $order_items = new OrderItemsClient();
                $order_items->order_client_id = $order_id;
                $order_items->product_id = $id;
                $order_items->client_id = Yii::$app->user->identity->id;
                $order_items->name = $item['name'];
                $order_items->price = $item['price'] * ((100 - Yii::$app->user->identity->discount) / 100);
                $order_items->qty_item = $item['qty'];
                $order_items->sum_item = $item['qty'] * $item['price'] * ((100 - Yii::$app->user->identity->discount) / 100);
                $order_items->save();
            }
        }
    }
}