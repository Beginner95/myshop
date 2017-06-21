<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Category;
use app\modules\admin\models\Price;
use app\modules\admin\models\Product;
use Yii;
use app\modules\admin\models\UploadForm;
use yii\web\UploadedFile;

class ImportController extends AppAdminController
{
    public $priceFile;
    public function actionUpload()
    {
        $model = new UploadForm();
        $model_category = new Category();
        if (Yii::$app->request->isPost) {
            $model->priceFile = UploadedFile::getInstance($model, 'priceFile');
            $model_category->id = (int)Yii::$app->request->post()['Category']['id'];
            if (true === $model->upload()) {
                return $this->xlsToMysql('upload/price-lists/' . date('d-m-Y H-i-s') . ' ' .$model->priceFile->name);
            }
        }

        return $this->render('upload', [
            'model' => $model,
            'model_category' => $model_category,
        ]);
    }

    public function xlsToMysql($file)
    {
        $config = new Price();
        $this->priceFile = $this->getPhpExcel($file);
        $this->priceFile->setActiveSheetIndex(0);
        $sheet = $this->priceFile->getActiveSheet();
        $rowIterator = $sheet->getRowIterator();
        $arr = [];
        foreach ($rowIterator as $row) {
            if ($row->getRowIndex() != 1) {
                $cellIterator = $row->getCellIterator();
                foreach ($cellIterator as $cell) {
                    $cellPath = $cell->getColumn();
                    if (isset($config->cells[$cellPath])) {
                        $arr[$row->getRowIndex()][$config->cells[$cellPath]] = $cell->getCalculatedValue();
                    }
                }
            }
        }

        foreach ($arr as $item) {
            $model = new Product();
            $model->category_id = (int)Yii::$app->request->post()['Category']['id'];
            $model->name = $item['name'];
            $model->model = $item['model'];
            $model->price = $item['price'];
            $model->wholesale_price = $item['wholesale_price'];
            $model->content = $item['content'];
            $model->status = (string)$item['status'];
            $model->sale = (string)$item['sale'];
            $model->new = (string)$item['new'];
            $model->hit = (string)$item['hit'];
            $model->keywords = $item['keywords'];
            $model->description = $item['description'];
            $model->save();
        }
        if (true === $model->save()) {
            Yii::$app->session->setFlash('success', 'Импорт товаров успешно выполнен!');
        } else {
            Yii::$app->session->setFlash('error', 'Произошла ошибка при импорте товаров, повторите попытку!');
        }
        return $this->redirect(['import/upload']);

    }

    public function getPhpExcel($file)
    {
        return \PHPExcel_IOFactory::load($file);
    }

}