<?php

namespace backend\widgets\sidebar;

use backend\modules\page\models\Page;
use yii\base\Widget;
use yii\helpers\Url;
use ArgumentCountError;
use Yii;

class SidebarWidget extends Widget
{
    public $data;
    public $sidebarName = false;
    public $side = false;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if ($this->sidebarName === false || empty($this->sidebarName)) {
            throw new ArgumentCountError('SidebarWidget takes property "SidebarName", 0 passed');
        }

        $this->setData();

        if ($this->side === 'right')
            return $this->render('sidebarRight', ['data' => $this->data[$this->sidebarName]]);

        return $this->render('sidebarLeft', ['data' => $this->data[$this->sidebarName]]);

    }

    private function setData()
    {
        $pages = Page::find()
            ->all();

        foreach ($pages as $page) {
            //$main[$page->page_title] = Url::to(["page/$page->slug/"]);
            $main[$page->page_title] = Url::to([
                "/page",
                'edit' => $page->slug,
                'type' => $page->type
                ]);
        }

        $this->data = [
            'main' => $main,


        ];
    }

}