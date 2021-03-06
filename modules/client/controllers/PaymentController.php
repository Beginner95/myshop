<?php

namespace app\modules\client\controllers;
use app\modules\client\models\Payment;
use app\modules\client\models\Transaction;
use Yii;
use yii\data\ActiveDataProvider;

class PaymentController extends AppClientController
{
    public function actionHistory()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Transaction::find()->orderBy('status ASC')->where(['user_id' => Yii::$app->user->identity->getId()]),
        ]);

        return $this->render('history', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Transaction();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->getId();
            $model->save();
            return $this->redirect(['payment/history']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

}