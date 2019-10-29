<?php

namespace backend\modules\certificate\controllers;

use backend\controllers\BaseController;
use backend\models\UploadModel;
use Yii;
use backend\modules\certificate\models\Certificate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\Storage;
use yii\web\UploadedFile;

/**
 * CertificateController implements the CRUD actions for Certificate model.
 */
class CertificateController extends BaseController
{

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Certificate();
        $uploadModel = new UploadModel(['scenario' => UploadModel::SCENARIO_UPLOAD_SINGLE]);

        if ($model->load(Yii::$app->request->post()) && $uploadModel->load(Yii::$app->request->post())) {

            if ($model->save()) {

                $storage = new Storage(Yii::getAlias(Yii::$app->params['certificateImgPath']), $model->image, $model->id);
                $uploadModel->image = UploadedFile::getInstance($uploadModel, 'image');

                if ($uploadModel->upload($uploadModel->image, 'image', $storage)
                    && $uploadModel->image !== false) {

                    $model->image = $uploadModel->image;
                    $model->save(false); //TODO hard code, sorry
                }

                Yii::$app->session->setFlash('success', Yii::t('app', 'Certificate created!'));
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model'       => $model,
            'uploadModel' => $uploadModel,
            'errors'      => $model->getErrorSummary(true),
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadModel = new UploadModel(['scenario' => UploadModel::SCENARIO_UPLOAD_SINGLE]);
        $storage = new Storage(Yii::getAlias(Yii::$app->params['certificateImgPath']), $model->image, $id);

        if ($model->load(Yii::$app->request->post()) && $uploadModel->load(Yii::$app->request->post())) {

            $uploadModel->image = UploadedFile::getInstance($uploadModel, 'image');

            if ($uploadModel->upload($uploadModel->image, 'image', $storage)) {

                if ($uploadModel->image !== false) $model->image = $uploadModel->image;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Certificate updated!'));
                    return $this->redirect(['update', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model'       => $model,
            'uploadModel' => $uploadModel,
            'errors'      => $model->getErrorSummary(true),
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
        $model = $this->findModel($id);
//        $storage = new Storage(Yii::getAlias(Yii::$app->params['certificateImgPath']), $model->image, $id);

//        if($model->delete() !== false)
        $model->delete();

        return $this->redirect(['/page', 'edit' => 'certificate']);
    }

    /**
     * Finds the Certificate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Certificate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Certificate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
