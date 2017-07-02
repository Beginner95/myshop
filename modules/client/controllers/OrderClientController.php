<?php

namespace app\modules\client\controllers;

use app\modules\client\models\OrderClient;
use app\modules\client\models\OrderItemsClient;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use Yii;

class OrderClientController extends AppClientController
{
    public static function getDate($date)
    {
        $d = \DateTime::createFromFormat('Y-m-d H:i:s', $date);
        return $d->format('d-m-Y');
    }

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
            'query' => OrderClient::find()->where(['client_id' => Yii::$app->user->identity->getId()]),
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

    public function actionView($id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrderClient::find()->where(['client_id' => Yii::$app->user->identity->getId()]),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_ASC,
                ],
            ],
        ]);
        $items = OrderItemsClient::find()->where(['order_client_id' => $id])->andWhere(['client_id' => Yii::$app->user->identity->getId()])->all();
        return $this->render('view', [
            'items' => $items,
            'dataProvider' => $dataProvider,
        ]);
    }

}
