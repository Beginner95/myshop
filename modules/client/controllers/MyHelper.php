<?php
/**
 * Created by PhpStorm.
 * User: Vaharsolta
 * Date: 05.07.2017
 * Time: 7:37
 */

namespace app\modules\client\controllers;
use yii\helpers\ArrayHelper;

class MyHelper
{
    /**
     * Аналог ArrayHelper::map склеивающий значения нескольких аттрибутов
     * @param $array|
     * @param $id
     * @param array $concattrs
     * @param string $separator
     * @return array
     */
    public static function cmap($array, $id, $concattrs=[], $separator=' '){
        $result = [];
        foreach ($array as $element) {
            $key = ArrayHelper::getValue($element, $id);
            $value=[];
            foreach($concattrs as $el){
                $value[] = ArrayHelper::getValue($element, $el);
            }
            $result[$key] = implode($separator, $value);
        }

        return $result;

    }
}