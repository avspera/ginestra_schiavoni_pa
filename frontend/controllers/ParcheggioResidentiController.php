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
use common\models\RichiesteTmp;
use common\models\Veicolo;
use yii\db\Exception;

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

        $cittadino = Cittadino::findOne(["id" => 1]);

        if ($cittadino->id != $model->id_cittadino) {
            return $this->redirect("error");
        }

        return $this->render('view', [
            'model' => $model,
            'cittadino' => $cittadino
        ]);
    }

    /**
     * Creates a new ParcheggioResidenti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id = NULL)
    {
        if (!empty($id)) {
            $model = ParcheggioResidenti::find()->where(["id" => $id])->one();
        } else {
            $model = new ParcheggioResidenti();
            $model->id_cittadino = 1;
            $model->step = 1;
            $model->stato_richiesta = \common\components\Utils::getStatoRichiestaFlipped("da_completare");

            try {
                $model->save(false);
            } catch (Exception $e) {
                Yii::$app->session->setFlash("error", "Impossibile procedere: " . $e->getMessage());
            }
        }

        $cittadino = \common\models\Cittadino::find()->where(["id" => 1])->one();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created_by = $cittadino->id;
                $model->stato_richiesta     = \common\components\Utils::getStatoRichiestaFlipped("in_lavorazione");
                $model->numero_protocollo   = \common\components\Utils::richiediNumeroProtocollo();

                if ($model->save(false)) {
                    RichiesteTmp::deleteAll(["external_id" => $id, "tipo_richiesta" => "parcheggio-residenti"]);

                    return $this->redirect(["confirmed", [
                        'id' => $model->id
                    ]]);
                }
            } else {
                Yii::$app->session->setFlash("error", "Ops...c'è stato qualche problema." . json_encode($model->getErrors()));
            }
        } else {
            $model->loadDefaultValues();
        }

        $vehicles = Veicolo::find()->where(["id_cittadino" => 1])->all();
        $steps = RichiesteTmp::find()->where([
            "id_cittadino" => $cittadino->id,
            "external_id" => $model->id,
            "tipo_richiesta" => Yii::$app->controller->id
        ])->orderBy(["step" => SORT_ASC])->all();

        return $this->render('create', [
            'model'         => $model,
            'cittadino'     => $cittadino,
            'vehicles'      => $vehicles,
            'steps'         => $steps
        ]);
    }

    public function actionConfirmed($id)
    {
        $model = $this->findModel($id);
        $cittadino = Cittadino::find()->select(["id", "fullname", "email"])->where(["id" => $model->id_cittadino])->one();

        return $this->render("confirmed", [
            'model' => $this->findModel($id),
            'cittadino' => $cittadino
        ]);
    }

    public function actionSaveStepData($id, $step)
    {
        $out = ["status" => 100, "mag" => "No Post call"];

        if (Yii::$app->request->isPost) {

            $data = Yii::$app->request->post();

            $dataJson = json_encode($data);

            $existing = RichiesteTmp::find()->where(['external_id' => $id, "tipo_richiesta" => Yii::$app->controller->id, "step" => $step])->one();
            if ($existing) {
                $existing->data = $dataJson;
            } else {
                $existing = new RichiesteTmp();
                $existing->created_at       = date("Y-m-d H:i:s");
                $existing->external_id      = $id;
                $existing->tipo_richiesta   = Yii::$app->controller->id;
                $existing->data             = $dataJson;
                $existing->id_cittadino     = $data["ParcheggioResidenti"]["id_cittadino"];
                $existing->step             = $step;
            }
            try {
                if ($existing->save()) {
                    $out = ["status" => 200, "mag" => "Data saved"];
                } else {
                    $out = ["status" => 200, "mag" => json_encode($existing->getErrors())];
                }
            } catch (Exception $e) {
                $out = ["status" => 100, "mag" => "No data saved"];
            }

            return json_encode($out);
        }
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
