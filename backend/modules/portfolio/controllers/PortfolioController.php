<?php

namespace backend\modules\portfolio\controllers;

use backend\controllers\BaseController;
use Yii;
use backend\components\Storage;
use yii\web\UploadedFile;
use backend\modules\portfolio\models\Portfolio;
use backend\models\UploadModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PortfolioController implements the CRUD actions for Portfolio model.
 */
class PortfolioController extends BaseController
{

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Portfolio();
        $uploadModel = new UploadModel(['scenario' => UploadModel::SCENARIO_UPLOAD_MULTIPLE]);
        $uploadPreview = new UploadModel(['scenario' => UploadModel::SCENARIO_UPLOAD_SINGLE]);

        if ($model->load(Yii::$app->request->post()) && $uploadModel->load(Yii::$app->request->post())) {

            if ($model->save()) {

                $storage = new Storage(Yii::getAlias(Yii::$app->params['portfolioImgPath']), false, $model->id);

                $uploadModel->image = UploadedFile::getInstances($uploadModel, 'image');
                $uploadModel->uploadMultiple($uploadModel->image, $storage);

                $uploadPreview->preview = UploadedFile::getInstance($uploadModel, 'preview');
                $uploadPreview->upload($uploadPreview->preview, 'preview', $storage);

                $model->preview = $uploadPreview->preview;
                $model->save(false); //TODO hard code, sorry

                Yii::$app->session->setFlash('success', Yii::t('app', 'Portfolio created!'));
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model'         => $model,
            'uploadModel'   => $uploadModel,
            'uploadPreview' => $uploadPreview,
            'errors'        => $model->getErrorSummary(true),
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadModel = new UploadModel(['scenario' => UploadModel::SCENARIO_UPLOAD_MULTIPLE]);
        $uploadPreview = new UploadModel(['scenario' => UploadModel::SCENARIO_UPLOAD_SINGLE]);
        $storage = new Storage(Yii::getAlias(Yii::$app->params['portfolioImgPath']), false, $id);

        if ($model->load(Yii::$app->request->post()) &&
            $uploadModel->load(Yii::$app->request->post()) &&
            $uploadPreview->load(Yii::$app->request->post())) {

            $uploadModel->image = UploadedFile::getInstances($uploadModel, 'image');
            $uploadPreview->preview = UploadedFile::getInstance($uploadPreview, 'preview');

            if ($uploadModel->uploadMultiple($uploadModel->image, $storage) &&
                $uploadPreview->upload($uploadPreview->preview, 'preview', $storage)) {

                if ($uploadPreview->preview !== false) $model->preview = $uploadPreview->preview;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Portfolio updated!'));
                    return $this->redirect(['update', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model'         => $model,
            'uploadModel'   => $uploadModel,
            'uploadPreview' => $uploadPreview,
            'errors'        => $model->getErrorSummary(true),
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id) //TODO remove files
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/page', 'edit' => 'portfolio']);
    }

    public function actionDeleteFile($id, $file)
    {

        $storage = new Storage(Yii::getAlias(Yii::$app->params['portfolioImgPath']), false, $id);
        $storage->removeFile($file);

        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Finds the Portfolio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Portfolio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Portfolio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
