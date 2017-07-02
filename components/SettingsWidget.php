<?php

namespace app\components;

use app\modules\admin\models\SiteSettings;
use yii\base\Widget;

class SettingsWidget extends Widget
{
    public $position;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $settings = SiteSettings::find()->asArray()->all();
        if ($this->position == 'logotip') {
            echo $settings[0]['logotip'];
        }

        if ($this->position == 'phone') {
            echo $settings[0]['phone'];
        }

        if ($this->position == 'name_company') {
            echo $settings[0]['name_company'];
        }

        if ($this->position == 'slogan') {
            echo $settings[0]['slogan'];
        }

        if ($this->position == 'address') {
            echo $settings[0]['address'];
        }

        if ($this->position == 'email') {
            echo $settings[0]['email'];
        }

        if ($this->position == 'usd') {
            echo $settings[0]['usd'];
        }

        if ($this->position == 'rub') {
            echo $settings[0]['rub'];
        }
    }
}