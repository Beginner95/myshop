<?php
/**
 * Created by PhpStorm.
 * User: Vaharsolta
 * Date: 01.07.2017
 * Time: 14:48
 */

namespace app\components;

use app\models\Order;
use app\modules\client\models\OrderClient;
use app\modules\client\models\OrderReturn;
use app\modules\client\models\Transaction;
use app\modules\client\models\User;
use Yii;
use yii\base\Widget;

class NotificationWidget extends Widget
{
    public $notice;
    public $data;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if ($this->notice == 'notice_order') {
            $this->data = OrderClient::find()->where(['status' => '0'])->orWhere(['status' => null])->asArray()->all();
            $this->data = count($this->data);
            echo $this->render('notice_order', ['notice' => $this->data]);
        }

        if ($this->notice == 'notice_order_client') {
            $this->data = OrderClient::find()->where(['status' => '0'])->orWhere(['status' => null])->asArray()->all();
            $this->data = count($this->data);
            echo $this->render('notice_order_client', ['notice' => $this->data]);
        }

        if ($this->notice == 'notice_orders') {
            $this->data = OrderClient::find()->where(['status' => '0'])->orWhere(['status' => null])->asArray()->all();
            $order = Order::find()->where(['status' => '0'])->orWhere(['status' => null])->asArray()->all();
            $this->data = count($this->data) + count($order);
            echo $this->render('notice_orders', ['notice' => $this->data]);
        }

        if ($this->notice == 'notice_return') {
            $this->data = OrderReturn::find()->where(['status' => '0'])->orWhere(['status' => null])->asArray()->all();
            $this->data = count($this->data);
            echo $this->render('notice_return', ['notice' => $this->data]);
        }

        if ($this->notice == 'notice_payment') {
            $this->data = Transaction::find()->where(['status' => '0'])->orWhere(['status' => null])->asArray()->all();
            $this->data = count($this->data);
            echo $this->render('notice_payment', ['notice' => $this->data]);
        }

        if ($this->notice == 'notice_user') {
            $this->data = User::find()->where(['status' => '0'])->orWhere(['status' => null])->asArray()->all();
            $this->data = count($this->data);
            echo $this->render('notice_user', ['notice' => $this->data]);
        }

    }
    
}