<?php

namespace backend\controllers;

use Yii;
use common\models\Cittadino;
use common\models\CittadinoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CittadinoController implements the CRUD actions for Cittadino model.
 */
class CittadinoController extends Controller
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
     * Lists all Cittadino models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CittadinoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cittadino model.
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
     * Creates a new Cittadino model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cittadino();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash("error", "Ops...c'è stato qualche problema. [CIT-101] " . json_encode($model->getErrors(), JSON_PRETTY_PRINT));
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSearchFromSelect($q = "", $id = null)
    {
        $term = $q;

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => [], "status" => "100"];

        if (!is_null($term)) {
            $data = Cittadino::find()
                ->select(["id", "nome", "cognome", 'email'])
                ->where(["LIKE", "cognome", $term])
                ->orWhere(["LIKE", "nome", $term])
                ->orWhere(["LIKE", "email", $term])
                ->orderBy(["nome" => SORT_ASC])
                ->distinct()->all();

            $i = 0;
            foreach ($data as $client) {
                $out["results"][$i]["id"]   = $client->id;
                $out["results"][$i]["text"] = $client->nome . " " . $client->cognome . " - " . $client->email;
                $i++;
            }

            if (!empty($out["results"])) {
                $out["status"] = "200";
            }
        } else if ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Cittadino::find($id)->cognome . " " . Cittadino::find($id)->nome];
        }
        return $out;
    }

    /**
     * Updates an existing Cittadino model.
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
     * Deletes an existing Cittadino model.
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
     * Finds the Cittadino model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cittadino the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cittadino::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
