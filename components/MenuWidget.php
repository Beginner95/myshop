<?php

namespace app\components;
use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $tpl;
    public $data;
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent::init();
        if ( $this->tpl === null ) {
            $this->tpl = 'menu';
        } else {
            $this->tpl .= '.php';
        }

    }

    public function run() {
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        return $this->tpl;
    }

    public function getTree() {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        return $tree;
    }
}