<?php

namespace app\components;

use app\models\Category;
use Yii;
use yii\base\Widget;


class MenuWidget extends Widget
{

    public $tpl;
    public $data;
    public $tree;
    public $menuHtml;
    public $model;


    public function init()
    {
        parent::init();
        if ($this->tpl === null) {
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run()
    {
        //get cashe

        if ($this->tpl == 'menu.php') {
            $menu = Yii::$app->cache->get('menu');
            if ($menu) return $menu;
        }

        /* 
        Чтоб поменять порядок вывода в меню, сначала поменять в товаре parent_id 
        для хлебных крошек, затем поменять категории id местами.

        UPDATE `products` SET category_id = " " WHERE category_id = " " 

        перенести все продукты в категорию - обновить
        UPDATE `products_categories` SET `id_categories`= " " WHERE id_categories = " " 

        */
        $this->data = Category::find()->indexBy('sort_index')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        if ($this->tpl == 'menu.php') {
            Yii::$app->cache->set('menu', $this->menuHtml, 60 * 3);
        }


        return $this->menuHtml;
    }

    public function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }

        return $tree;
    }

    protected function getMenuHtml($tree, $tab = "")
    {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTamlate($category, $tab);
        }
        return $str;
    }

    protected function catToTamlate($category, $tab)
    {
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}
