<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use app\models\Slider;
use Yii;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController
{
    public function actionIndex() {
        $sliders = Slider::find()->asArray()->all();
        $hits = Product::find()->where(['hit' => '1', 'status' => '1'])->limit(8)->all();
        return $this->render('index', compact('hits', 'sliders'));
    }

    public function actionView($id) {
        //$id = Yii::$app->request->get('id');
        $category = Category::findOne($id);

        if (empty($category)) {
            throw new HttpException(404, 'Такой категории нет');
        }

        //$products = Product::find()->where(['category_id' => $id])->all();
        $query = Product::find()->where(['category_id' => $id, 'status' => '1']);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta('Магазин ' . $category->name, $category->keywords, $category->description);
        return $this->render('view', compact('products', 'pages', 'category'));
    }

}