<?php

namespace backend\modules\product\controllers;

use Yii;
use backend\models\UploadModel;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use backend\controllers\BaseController;
use backend\modules\product\models\Product;
use backend\components\Storage;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
{

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();
        $uploadModel = new UploadModel(['scenario' => UploadModel::SCENARIO_UPLOAD_SINGLE]);

        if ($model->load(Yii::$app->request->post()) && $uploadModel->load(Yii::$app->request->post())) {

            if ($model->save()) {

                $storage = new Storage(Yii::getAlias(Yii::$app->params['productImgPath']), $model->image, $model->id);
                $uploadModel->image = UploadedFile::getInstance($uploadModel, 'image');

                if ($uploadModel->upload($uploadModel->image, 'image', $storage)
                    && $uploadModel->image !== false) {

                    $model->image = $uploadModel->image;
                    $model->save(false); //TODO hard code, sorry
                }

                Yii::$app->session->setFlash('success', Yii::t('app', 'Product created!'));
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        $model->published = 1;

        return $this->render('create', [
            'model'       => $model,
            'uploadModel' => $uploadModel,
            'errors'      => $model->getErrorSummary(true),
        ]);

    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\base\Exception
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $uploadModel = new UploadModel(['scenario' => UploadModel::SCENARIO_UPLOAD_SINGLE]);
        $storage = new Storage(Yii::getAlias(Yii::$app->params['productImgPath']), $model->image, $id);

        if ($model->load(Yii::$app->request->post()) && $uploadModel->load(Yii::$app->request->post())) {

            $uploadModel->image = UploadedFile::getInstance($uploadModel, 'image');

            if ($uploadModel->upload($uploadModel->image, 'image', $storage)) {

                if ($uploadModel->image !== false) $model->image = $uploadModel->image;

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Product updated!'));
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/page', 'edit' => 'product']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
