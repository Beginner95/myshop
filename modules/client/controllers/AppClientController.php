<?php

namespace app\modules\client\controllers;
use app\modules\client\models\Payment;

use yii\web\Controller;

class AppClientController extends Controller
{
    protected function setMeta($title = null, $keywords = null, $description = null) {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "" .$keywords . ""]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "" . $description . ""]);
    }

}