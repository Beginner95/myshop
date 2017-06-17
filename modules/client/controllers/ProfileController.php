<?php

namespace app\modules\client\controllers;

use Yii;
use app\modules\client\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class ProfileController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }

    public function actionPasswordChange()
    {
        $model = $this->findModel();
        if ($model->load(Yii::$app->request->post())) {
            if (false === $model->validatePassword(Yii::$app->request->post()['User']['currentPassword'])) {
                Yii::$app->session->setFlash('error', 'Ошибка не верный текущий пароль!');
                return $this->render('password-change', [
                    'model' => $model,
                ]);
            }
            if (Yii::$app->request->post()['User']['newPassword'] !== Yii::$app->request->post()['User']['newPasswordRepeat']) {
                Yii::$app->session->setFlash('error', 'Ошибка пароли не совпадают!');
                return $this->render('password-change', [
                    'model' => $model,
                ]);
            }
            $model->changePassword();
            return $this->redirect(['profile/index']);
        } else {
            return $this->render('password-change', [
                'model' => $model,
            ]);
        }
    }


    protected function findModel()
    {
        if (($model = User::findOne(Yii::$app->user->identity->getId())) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
