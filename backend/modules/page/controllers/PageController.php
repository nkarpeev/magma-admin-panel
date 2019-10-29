<?php

namespace backend\modules\page\controllers;

use Yii;
use backend\controllers\BaseController;
use backend\modules\page\models\Page;
use backend\models\UploadModel;
use backend\components\ContentService;
use backend\components\Storage;
use yii\web\UploadedFile;


/**
 * Page controller for the `page` module
 */
class PageController extends BaseController
{

    /**
     * @param $edit
     * @param $type
     * @return string|\yii\web\Response
     */
    public function actionIndex($edit, $type)
    {
        $model = Page::findOne(['slug' => $edit]);
        $errors = [];

        if ($type === Page::TYPE_CONTENT) {

            try {
                $storage = new Storage(Yii::getAlias(Yii::$app->params['contentImgPath']));
                $classNameEditModel = "backend\models\\" . ucfirst($edit) . ucfirst($type);
                $contentService = new ContentService($classNameEditModel::className());
                $uploadModel = new UploadModel(['scenario' => UploadModel::SCENARIO_UPLOAD_SINGLE]);


                $editModel = $contentService->getContentModel($edit);
                $dataProvider = false;
                $searchModel = false;

                if (Yii::$app->request->isPost
                    && $editModel->load(Yii::$app->request->post()) && $editModel->save()
                    && $model->load(Yii::$app->request->post()) && $model->save()) {

                    if ($uploadModel->load(Yii::$app->request->post())) {
                        $images = [];

                        foreach ($uploadModel->image as $key => $image) {
                            $images[$key] = UploadedFile::getInstance($uploadModel, "image[$key]");
                            $uploadModel->upload(UploadedFile::getInstance($uploadModel, "image[$key]"), 'image', $storage);
                            if ($uploadModel->image !== false) $editModel->$key = $uploadModel->image;
                        }

                        $editModel->save(false, array_keys($images));
                    }

                    Yii::$app->session->setFlash('success', Yii::t('app', 'Page updated!'));
                    return $this->redirect(['', 'edit' => $model->slug, 'type' => $model->type]);
                }

            } catch (\Error $e) {
                $editModel = false;
                $dataProvider = false;
                $searchModel = false;
                $uploadModel = false;
                $errors[] = $e->getMessage();
                $errors[] = $e->getFile();
                $errors[] = "in {$e->getLine()} line";
            }

        } else {

            $classNameSearch = "backend\modules\\$edit\models\\" . ucfirst($edit) . 'Search';
            $classNameEditModel = "backend\modules\\$edit\models\\" . ucfirst($edit);
            $uploadModel = false;

            try {
                $searchModel = new $classNameSearch();
                $editModel = new $classNameEditModel();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            } catch (\Error $e) {
                $dataProvider = false;
                $searchModel = false;
                $editModel = false;
                $errors[] = $e->getMessage();
                $errors[] = $e->getFile();
                $errors[] = "in {$e->getLine()} line";
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Page updated!'));
                return $this->redirect(['', 'edit' => $model->slug, 'type' => $model->type]);
            }
        }


        return $this->render('edit', [
            'model'        => $model,
            'editModel'    => $editModel,
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
            'uploadModel'  => $uploadModel,
            'errors'       => $errors,
        ]);
    }
}
