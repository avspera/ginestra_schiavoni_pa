<?php

namespace frontend\controllers;

use Yii;
use common\models\AttoDiMatrimonio;
use common\models\AttoDiMatrimonioSearch;
use common\models\RichiesteTmp;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AttoDiMatrimonioController implements the CRUD actions for AttoDiMatrimonio model.
 */
class AttoDiMatrimonioController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    // [
                    //     'actions' => ['create'],
                    //     'allow' => true,
                    //     'roles' => ['@'],
                    // ],
                    [
                        'actions' => ['view', 'index', 'create', 'save-step-data', 'confirmed'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all AttoDiMatrimonio models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AttoDiMatrimonioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AttoDiMatrimonio model.
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

    /**
     * Creates a new AttoDiMatrimonio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id = NULL)
    {
        $cittadino = \common\models\Cittadino::find()->where(["id" => 1])->one();

        if (!empty($id)) {
            $model = AttoDiMatrimonio::find()->where(["id" => $id])->one();
        } else {
            $model = new AttoDiMatrimonio();
            $model->id_cittadino = 1;
            $model->step = 1;
            $model->stato_richiesta = \common\components\Utils::getStatoRichiestaFlipped("da_completare");
            $model->created_by          = $cittadino->id;
            try {
                $model->save(false);
            } catch (Exception $e) {
                Yii::$app->session->setFlash("error", "Impossibile procedere: " . $e->getMessage());
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->stato_richiesta     = \common\components\Utils::getStatoRichiestaFlipped("in_lavorazione");
                $model->numero_protocollo   = \common\components\Utils::richiediNumeroProtocollo();
                $model->data_richiesta      = date("Y-m-d H:i:s");

                if ($model->save(false)) {
                    RichiesteTmp::deleteAll(["external_id" => $id, "tipo_richiesta" => Yii::$app->controller->id]);

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

        $steps = RichiesteTmp::find()->where([
            "id_cittadino" => $cittadino->id,
            "external_id" => $model->id,
            "tipo_richiesta" => Yii::$app->controller->id
        ])->orderBy(["step" => SORT_ASC])->all();

        $coniuge = \common\models\Coniuge::find()->where(["id_cittadino" => $cittadino->id])->all();

        return $this->render('create', [
            'model'         => $model,
            'cittadino'     => $cittadino,
            'steps'         => $steps,
            'coniuge'       => $coniuge
        ]);
    }

    public function actionConfirmed($id)
    {
        $model = $this->findModel($id);
        $cittadino = \common\models\Cittadino::find()->select(["id", "fullname", "email"])->where(["id" => $model->id_cittadino])->one();

        return $this->render("confirmed", [
            'model' => $this->findModel($id),
            'cittadino' => $cittadino
        ]);
    }

    public function actionSaveStepData($id, $step)
    {
        $out = ["status" => 100, "msg" => "No Post call"];

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
                $existing->id_cittadino     = $data["AttoDiMatrimonio"]["id_cittadino"];
                $existing->step             = $step;
            }
            try {
                if ($existing->save()) {
                    $out = ["status" => 200, "msg" => "Data saved"];
                } else {
                    $out = ["status" => 200, "msg" => json_encode($existing->getErrors())];
                }
            } catch (Exception $e) {
                $out = ["status" => 100, "msg" => "No data saved"];
            }

            return json_encode($out);
        }
    }

    /**
     * Updates an existing AttoDiMatrimonio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AttoDiMatrimonio model.
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
     * Finds the AttoDiMatrimonio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AttoDiMatrimonio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AttoDiMatrimonio::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
