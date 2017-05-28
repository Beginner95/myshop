<?php

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class ProductController extends AppController
{
    public function actionView($id) {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        //$product = Product::find()->with('category')->where(['id' => $id]);
        $this->setMeta('Магазин ' . $product->name, $product->keywords, $product->description);
        return $this->render('view', compact('product'));
    }
}