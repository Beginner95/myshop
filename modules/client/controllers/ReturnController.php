<?php

namespace app\modules\client\controllers;

use app\modules\client\models\OrderItemsClient;
use app\modules\client\models\OrderClient;
use app\modules\client\models\OrderItemsReturn;
use app\modules\client\models\OrderReturn;
use Yii;
use yii\data\ActiveDataProvider;
class ReturnController extends AppClientController
{
    public function actionIndex()
    {
        $items = OrderItemsClient::find()->where(['client_id' => Yii::$app->user->identity->getId()])->all();
        return $this->render('index', [
            'items' => $items,
        ]);
    }
    
    public function actionHistory()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderReturn::find()->where(['user_id' => Yii::$app->user->identity->getId()]),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_ASC,
                ],
            ],
        ]);

        return $this->render('history', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderReturn::find()->where(['user_id' => Yii::$app->user->identity->getId()]),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_ASC,
                ],
            ],
        ]);
        $items = OrderItemsReturn::find()->where(['order_return_id' => $id])->andWhere(['user_id' => Yii::$app->user->identity->getId()])->all();
        return $this->render('view', [
            'items' => $items,
            'dataProvider' => $dataProvider,
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
            foreach ($items as $item) {
                $model->sum += Yii::$app->request->post()['OrderItemsClient']['qty_item'][$item->id] * $item->price;
            }
            $model->qty = array_sum(Yii::$app->request->post()['OrderItemsClient']['qty_item']);
            $model->user_id = Yii::$app->user->identity->getId();
            if (true === $model->save()) {
                $this->saveOrderItemsReturn($items, $model->id, $desc);
            }
        }
        return $this->redirect(['return/history']);
    }


    protected function saveOrderItemsReturn($items, $order_id, $desc)
    {
        foreach ($items as $id => $item) {
            $order_items = new OrderItemsReturn();
            $order_items->order_return_id = $order_id;
            $order_items->product_id = $item->product_id;
            $order_items->user_id = Yii::$app->user->identity->getId();
            $order_items->name = $item->name;
            $order_items->price = (float)$item->price;
            $order_items->qty_item = Yii::$app->request->post()['OrderItemsClient']['qty_item'][$item->id];
            $order_items->sum_item = Yii::$app->request->post()['OrderItemsClient']['qty_item'][$item->id] * $item->price;
            $order_items->description = $desc['description'][$item->id];
            $order_items->date_added = $item->date_added;
            $order_items->save();
        }
        if (true === $order_items->save()) {
            $this->deleteOrderItemsReturn($items);
        }
    }

    protected function deleteOrderItemsReturn($items)
    {
        foreach ($items as $item) {
            $model = OrderItemsClient::findOne(['id' => $item->id]);
            $qty = ($model->qty_item - (int)Yii::$app->request->post()['OrderItemsClient']['qty_item'][$item->id]);
            if (0 === $qty) {
                $order_items[$item->order_client_id] = $item->order_client_id;
                $model->delete();
            } else {
                $model->qty_item = $qty;
                $model->sum_item = $item->price * $qty;
                $model->save();
                $order_items[$item->order_client_id] = $item->order_client_id;
            }
        }

        if (isset($order_items) || true === $model->save()) {
            $this->refreshOrder($order_items);
        }
    }

    protected function refreshOrder($order_items)
    {
        foreach ($order_items as $item) {
            $order_items_id = OrderItemsClient::findOne(['order_client_id' => $item]);
            $model = OrderClient::findOne(['id' => $item]);
            if (null === $order_items_id) {
                $model->delete();
            } else {
                $sum = OrderItemsClient::find()
                    ->where(['order_client_id' => $item])
                    ->sum('[[sum_item]]');
                $qty = OrderItemsClient::find()
                    ->where(['order_client_id' => $item])
                    ->sum('[[qty_item]]');
                $model->sum = $sum;
                $model->qty = $qty;
                $model->save();
            }
        }
    }
}