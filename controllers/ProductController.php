<?php

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\web\HttpException;

class ProductController extends AppController
{
    public function actionView($id) {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (empty($product)) {
            throw new HttpException(404, 'Такого товара нет');
        }
        //$product = Product::find()->with('category')->where(['id' => $id]);
        $this->setMeta('Магазин ' . $product->name, $product->keywords, $product->description);
        return $this->render('view', compact('product'));
    }
}