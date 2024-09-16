<?php

namespace backend\controllers;

use common\components\Utils;
use common\models\AccessoAtti;
use common\models\AccessoAttiSearch;
use Pagamento;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccessoAttiController implements the CRUD actions for AccessoAtti model.
 */
class AccessoAttiController extends Controller
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
     * Lists all AccessoAtti models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AccessoAttiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccessoAtti model.
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

    public function actionChageStatus($id, $new_status)
    {
        if (empty($id) || empty($new_status)) return;

        $model = $this->findModel($id);
        $prevStatus = $model->stato_richiesta;

        if ($new_status == $model->stato_richiesta_choices_flipped["approvata"]) {
            if ($model->type == $model->type_choices["urgenza"]) {
                $out = Pagamento::generate($model);
                if ($out["status"] == 200) {
                    $model->id_univoco_versamento = $out["id_univoco_versamento"];
                }
            }
        }

        $model->stato_richiesta = $model->stato_richiesta_choices[$new_status];

        try {
            $model->save(false);

            $logParams["LogRichieste"] = [
                'id_model'      => $model->id,
                'model_type'    => "accesso-agli-atti",
                "prev_status"    => $prevStatus,
                'new_status'     => $model->stato_richiesta,
                'action'        => "change_status",
                'notes'         => $model->note,
                'coming_from'   => "internal"
            ];

            Utils::writeLogs($logParams);
        } catch (Exception $e) {
            \Yii::$app->session->setFlash("error", "Ops...operazione non riuscita. ERRORE [ACCESSO-ATTI-103]: " . $e->getMessage());
        }
    }

    /**
     * Deletes an existing AccessoAtti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $logParams["LogRichieste"] = [
            'id_model'      => $model->id,
            'model_type'    => "accesso-agli-atti",
            "prev_status"    => $model->stato_richiesta,
            'new_status'     => Utils::getStatoRichiesta("cancellata"),
            'action'        => "change_status",
            'notes'         => $model->note,
            'coming_from'   => "internal"
        ];

        $model->delete();

        Utils::writeLogs($logParams);

        return $this->redirect(['index']);
    }

    /**
     * Finds the AccessoAtti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AccessoAtti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccessoAtti::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
