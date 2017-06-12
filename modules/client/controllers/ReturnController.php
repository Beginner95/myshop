<?php

namespace app\modules\client\controllers;

use app\modules\client\models\OrderItemsClient;
use app\modules\client\models\OrderItemsReturn;
use app\modules\client\models\OrderReturn;
use Yii;
class ReturnController extends AppClientController
{
    public function actionIndex()
    {

        $items = OrderItemsClient::find()->where(['client_id' => Yii::$app->user->identity->id])->all();
        return $this->render('index', [
            'items' => $items,
        ]);
    }

    public function actionList()
    {
        if (Yii::$app->request->post()) {
            $items = OrderItemsClient::findAll(['id' => array_diff($_POST['OrderItemsClient']['id'], ['0'])]);
            return $this->render('list', [
                'items' => $items,
            ]);
        } else {
            return $this->render('list', ['items' => false]);
        }
    }

    
    public function actionReturn()
    {

        $items = OrderItemsClient::findAll(['id' => array_diff(Yii::$app->request->post()['OrderItemsClient']['id'], ['0'])]);
        $post = new OrderItemsClient();
        $model = new OrderReturn();
        $desc['description'] = Yii::$app->request->post()['OrderItemsClient']['description'];
        if ($post->load(Yii::$app->request->post())) {
            $model->sum = Yii::$app->request->post()['OrderItemsClient']['sum'];
            $model->qty = Yii::$app->request->post()['OrderItemsClient']['qty'];
            $model->user_id = Yii::$app->user->identity->id;
            if (true === $model->save()) {
                $this->saveOrderItemsReturn($items, $model->id, $desc);
            }
        }
    }


    protected function saveOrderItemsReturn($items, $order_id, $desc)
    {

        foreach ($items as $id => $item) {
            $order_items = new OrderItemsReturn();
            $order_items->order_return_id = $order_id;
            $order_items->product_id = $item->product_id;
            $order_items->user_id = Yii::$app->user->identity->id;
            $order_items->name = $item->name;
            $order_items->price = (float)$item->price;
            $order_items->qty_item = $item->qty_item;
            $order_items->sum_item = $item->qty_item * $item->price;
            $order_items->description = $desc['description'][$item->id];
            $order_items->save();
        }
        if (true === $order_items->save()) {
            $this->deleteOrderItemsReturn();
        }
    }

    protected function deleteOrderItemsReturn()
    {
        OrderItemsClient::deleteAll(['id' => array_diff(Yii::$app->request->post()['OrderItemsClient']['id'], ['0'])]);
    }
}