<?php

namespace frontend\controllers;

use Yii;
use common\models\ParcheggioResidenti;
use common\models\ParcheggioResidentiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\models\Cittadino;

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
        $model = $this->findModel($id);
        $loggedUser = Cittadino::getFakeCittadino();

        if ($model->cf_richiedente !== $loggedUser["fiscal_code"]) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ParcheggioResidenti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ParcheggioResidenti();
        $model->id = !empty($id) ? $id : \common\components\Utils::generateRandomId();
        $loggedUser = Cittadino::getFakeCittadino();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_by = $loggedUser["id"];

                $model->carta_identita = UploadedFile::getInstances($model, "carta_identita");
                if (!empty($model->carta_identita)) {
                    $model->carta_identita = $model->uploadFiles($model->carta_identita);
                }
                $model->carta_circolazione = UploadedFile::getInstances($model, "carta_circolazione");
                if (!empty($model->carta_circolazione)) {
                    $model->carta_circolazione = $model->uploadFiles($model->carta_circolazione);
                }

                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                Yii::$app->session->setFlash("error", "Ops...c'è stato qualche problema." . json_encode($model->getErrors()));
            }
        } else {
            $model->loadDefaultValues();
        }


        return $this->render('create', [
            'model' => $model,
            'loggedUser' => $loggedUser
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

        $loggedUser = Cittadino::getFakeCittadino();

        $oldCartaCircolazione   = $model->carta_circolazione;
        $oldCartaIdentita       = $model->carta_identita;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->updated_by = $loggedUser["id"];
            $model->carta_identita = UploadedFile::getInstances($model, "carta_identita");
            if (!empty($model->carta_identita) && $model->carta_identita !== $oldCartaIdentita) {
                $model->carta_identita = $model->uploadFiles($model->carta_identita);
            }

            $model->carta_circolazione = UploadedFile::getInstances($model, "carta_circolazione");
            if (!empty($model->carta_circolazione) && $model->carta_circolazione !== $oldCartaCircolazione) {
                $model->carta_circolazione = $model->uploadFiles($model->carta_circolazione);
            }
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'loggedUser' => $loggedUser
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
