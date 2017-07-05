<?php

namespace app\modules\admin\controllers;

use app\controllers\AppController;
use app\modules\client\models\Payment;
use app\modules\admin\models\Delivery;
use app\modules\client\models\OrderItemsClient;
use Yii;
use app\modules\admin\models\OrderClient;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderClientController extends AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderClient::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_ASC,
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderClient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderClient::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderClient();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $items = OrderItemsClient::find()->where(['order_client_id' => $id])->all();
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ('0' != $model->status && '1' != $model->status) {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            $cost = Delivery::find()
                ->select(['cost'])
                ->where(['id' => $model->delivery_id])
                ->one();
            if (0 == $this->updateOrderItemsClient($items)) {
                $model->sum = 0;
            } else {
                $model->sum = $this->updateOrderItemsClient($items) + $cost->cost;
            }
            if (true === $model->save()) {
                $this->setBalance($model->sum, $id);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'items' => $items,
        ]);
    }

    protected function updateOrderItemsClient($items)
    {
        $sum = 0;
        foreach ($items as $item) {
            $order_items = OrderItemsClient::findOne($item->id);
            $order_items->availability = Yii::$app->request->post()['availability'][$item->id];
            if ($order_items->availability != 0) {
                $sum += Yii::$app->request->post()['OrderItemsClient']['sum_item'][$item->id];
            }
            $order_items->save();
        }
        return $sum;
    }

    protected function setBalance($sum, $order_id)
    {
        $payment_update = Payment::findOne(['order_client_id' => $order_id]);
        if (null === $payment_update) {
            $payment = new Payment();
            $payment->client_id = Yii::$app->request->post()['OrderClient']['client_id'];
            $payment->order_client_id = $order_id;
            $payment->amount = $this->getBalance()['amount'] - $sum;
            $payment->description = 'Оплата заказа ' . $order_id;
            $payment->save();
        } else {
            $payment_update->amount =  '-'.$sum;
            $payment_update->save();
        }
    }

    protected function getBalance()
    {
        return Payment::find()
            ->select(['amount'])
            ->where(['client_id' => Yii::$app->request->post()['OrderClient']['client_id']])
            ->asArray()
            ->orderBy('id DESC')
            ->one();
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        OrderItemsClient::deleteAll(['order_client_id' => $id]);
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
}
