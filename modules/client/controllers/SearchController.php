<?php

namespace app\modules\client\controllers;
use yii\data\Pagination;
use app\models\Product;
use Yii;

class SearchController extends AppClientController
{
    public function actionSearch() {
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('Поиск ' . $q);
        if (empty($q)) {
            return $this->render('search', compact('q'));
        }
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'q'));
    }
}