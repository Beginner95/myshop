<?php

namespace app\modules\client\controllers;

use app\modules\client\models\OrderClient;
use app\modules\client\models\OrderItemsClient;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class OrderClientController extends AppClientController
{
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

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderClient::find(),
            'pagination' => [
                'pageSize' => 20,
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

    public static function getDate($date)
    {
        $d = \DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $d->format('d-m-Y');
    }


    public function actionView($id)
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
        $items = OrderItemsClient::find()->where(['order_client_id' => $id])->all();
        return $this->render('view', [
            'items' => $items,
            'dataProvider' => $dataProvider,
        ]);
    }

}
