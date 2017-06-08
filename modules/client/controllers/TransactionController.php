<?php

namespace app\modules\client\controllers;
use app\modules\client\models\Transaction;
use Yii;
use yii\data\ActiveDataProvider;

class TransactionController extends AppClientController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Transaction::find()->with('user'),
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Transaction();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->save();
            return $this->redirect(['transaction/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
}