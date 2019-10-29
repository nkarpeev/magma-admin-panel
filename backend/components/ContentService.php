<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 10/19/18
 * Time: 12:29 PM
 */

namespace backend\components;


class ContentService implements IContentService
{

    private $modelName;

    public function __construct(string $modelName)
    {
        $this->modelName = $modelName;
    }

    public function getContentModel($slug) :IContent {

        $model = $this->modelName::findOne(['slug' => $slug]);

        if($model === null)
            $model = new $this->modelName();

        $model->slug = $slug;

        return $model;
    }

}