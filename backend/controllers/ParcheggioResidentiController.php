<?php

namespace backend\controllers;

use common\models\ParcheggioResidenti;
use common\models\ParcheggioResidentiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ParcheggioResidentiController implements the CRUD actions for ParcheggioResidenti model.
 */
class ParcheggioResidentiController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ParcheggioResidenti models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ParcheggioResidentiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ParcheggioResidenti model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        $model->approved            = 1;
        $model->approved_by         = \Yii::$app->user->identity->id;
        $model->data_rilascio       = date("Y-m-d H:i:s");

        if ($model->save(false)) {
            \Yii::$app->session->setFlash("success", "Permesso parcheggio residenti approvato correttamente");
        } else {
            \Yii::$app->session->setFlash("warning", "Ops...c'è stato qualche problema");
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Creates a new ParcheggioResidenti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ParcheggioResidenti();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->carta_identita = UploadedFile::getInstances($model, 'carta_identita');

                if (!empty($model->carta_identita)) {
                    $model->carta_identita = $model->uploadFiles($model->carta_identita);
                } else {
                    $model->carta_identita = NULL;
                }
                $model->carta_circolazione = UploadedFile::getInstances($model, 'carta_circolazione');
                if (!empty($model->carta_circolazione)) {
                    $model->carta_circolazione = $model->uploadFiles($model->carta_circolazione);
                } else {
                    $model->carta_circolazione = NULL;
                }

                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    \Yii::$app->session->setFlash("error", "Ops...c'è stato qualche problema");
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ParcheggioResidenti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $prevCartaIdentita = json_decode($model->carta_identita, true);
        $prevCartaCircolazione = json_decode($model->carta_circolazione, true);
        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->carta_identita = UploadedFile::getInstances($model, 'carta_identita');
            if (!empty($model->carta_identita)) {
                $newAttachments = $model->uploadFiles($model->carta_identita);
                if (!empty($prevCartaIdentita)) {
                    $model->carta_circolazione = array_merge($prevCartaIdentita, json_decode($newAttachments, true));
                } else {
                    $model->carta_circolazione = json_decode($newAttachments, true);
                }
                $model->carta_identita = json_encode($model->carta_identita);
            } else {
                $model->carta_identita = json_encode($prevCartaIdentita);
            }

            $model->carta_circolazione = UploadedFile::getInstances($model, 'carta_circolazione');
            if (!empty($model->carta_circolazione)) {
                $newAttachments = $model->uploadFiles($model->carta_circolazione);
                if (!empty($prevCartaCircolazione)) {
                    $model->carta_circolazione = array_merge($prevCartaCircolazione, json_decode($newAttachments, true));
                } else {
                    $model->carta_circolazione = json_decode($newAttachments, true);
                }

                $model->carta_circolazione = json_encode($model->carta_circolazione);
            } else {
                $model->carta_circolazione = json_encode($prevCartaCircolazione);
            }

            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ParcheggioResidenti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ParcheggioResidenti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ParcheggioResidenti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ParcheggioResidenti::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
