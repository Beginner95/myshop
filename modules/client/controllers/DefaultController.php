<?php

namespace app\modules\client\controllers;
use yii\data\Pagination;
use app\modules\client\models\Product;
use app\modules\client\models\Payment;
use Yii;

class DefaultController extends AppClientController
{
    public function actionIndex()
    {
        $session =Yii::$app->session;
        $session->open();
        $balance = $this->getBalance();
        return $this->render('index', compact('balance', 'session'));
    }

    public function actionSearch() {
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('Поиск ' . $q);
        if (empty($q)) {
            return $this->render('index', compact('q'));
        }
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $balance = $this->getBalance();
        $session =Yii::$app->session;
        $session->open();
        return $this->render('index', compact('products', 'pages', 'q', 'balance', 'session'));
    }

    public function getBalance()
    {
        return $balance = Payment::find()->where(['client_id' => Yii::$app->user->identity->getId()])->sum('amount');
    }



}
