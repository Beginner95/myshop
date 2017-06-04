<?php

namespace app\modules\client\controllers;

use app\modules\client\controllers\AppClientController;

/**
 * Default controller for the `client` module
 */
class ClientController extends AppClientController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
