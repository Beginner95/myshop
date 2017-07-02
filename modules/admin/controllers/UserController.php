<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\OrderClient;
use app\modules\admin\models\OrderReturn;
use app\modules\admin\models\Transaction;
use app\modules\client\models\OrderItemsClient;
use app\modules\client\models\OrderItemsReturn;
use app\modules\client\models\Payment;
use Yii;
use app\modules\admin\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();


        if ($model->load(Yii::$app->request->post())) {

            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $current_password = $model->password;
        if ($model->load(Yii::$app->request->post())) {
            if ($current_password != Yii::$app->request->post()['User']['password']) {
                $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post()['User']['password']);
            }
            if (true === $model->save()) {
                if (0 == $model->status) {
                    Yii::$app->mailer->compose('registration_answer', ['model' => $model])
                        ->setFrom(['fetp95@mail.ru' => 'MyShop'])
                        ->setTo($model->email)
                        ->setSubject('Ваш аккаунт заблокирован!')
                        ->send();
                } else {
                    Yii::$app->mailer->compose('registration_answer', ['model' => $model])
                        ->setFrom(['fetp95@mail.ru' => 'MyShop'])
                        ->setTo($model->email)
                        ->setSubject('Ваш аккаунт активирован!')
                        ->send();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Transaction::deleteAll(['user_id' => $id]);
        Payment::deleteAll(['client_id' => $id]);
        OrderItemsClient::deleteAll(['client_id' => $id]);
        OrderItemsReturn::deleteAll(['user_id' => $id]);
        OrderClient::deleteAll(['client_id' => $id]);
        OrderReturn::deleteAll(['user_id' => $id]);
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
}
