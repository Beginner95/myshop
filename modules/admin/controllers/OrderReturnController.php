<?php

namespace app\modules\admin\controllers;

use app\modules\client\models\OrderItemsReturn;
use Yii;
use app\modules\admin\models\OrderReturn;
use app\modules\client\models\Payment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderReturnController implements the CRUD actions for OrderReturn model.
 */
class OrderReturnController extends Controller
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
     * Lists all OrderReturn models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderReturn::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderReturn model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the OrderReturn model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return OrderReturn the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderReturn::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new OrderReturn model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderReturn();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OrderReturn model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $status = $model->status;
        if ($model->load(Yii::$app->request->post())) {
            if ('0' != $model->status && '1' != $model->status) {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            if ($status != Yii::$app->request->post()['OrderReturn']['status']) {
                if (true === $model->save()) {
                    if (1 == $model->status) {
                        $this->setBalance($model->sum, $id, '+');
                    } else {
                        $this->setBalance($model->sum, $id, '-');
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function setBalance($sum, $order_id, $op)
    {
        $payment_update = Payment::findOne(['order_client_id' => $order_id]);
        if (null === $payment_update) {
            $payment = new Payment();
            $payment->client_id = Yii::$app->request->post()['OrderReturn']['user_id'];
            $payment->order_client_id = $order_id;
            if ('+' == $op){
                $payment->amount = $this->getBalance()['amount'] + $sum;
            } else {
                $payment->amount = $this->getBalance()['amount'] - $sum;
            }
            $payment->description = 'Оплата заказа ' . $order_id;
            $payment->save();
        } else {
            if ('+' == $op){
                $payment_update->amount = $this->getBalance()['amount'] + $sum;
            } else {
                $payment_update->amount = $this->getBalance()['amount'] - $sum;
            }
            $payment_update->save();
        }

    }

    protected function getBalance()
    {
        return Payment::find()
            ->select(['amount'])
            ->where(['client_id' => Yii::$app->request->post()['OrderReturn']['user_id']])
            ->asArray()
            ->orderBy('id DESC')
            ->one();
    }

    /**
     * Deletes an existing OrderReturn model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        OrderItemsReturn::deleteAll(['order_return_id' => $id]);
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
}
