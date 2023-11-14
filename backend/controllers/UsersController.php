<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use components\utils\Utils;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'view',
                            'update',
                            'delete',
                            'send-credentials',
                            'generate-random-password',
                            'set-status'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [
                            'check-email',
                            'create'
                        ],
                        'allow' => true,
                        'allow' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $password = $model->password;
            $model->status      = User::STATUS_ACTIVE;
            $model->setPassword($model->password);

            if ($model->save(false)) {
                $model->password = $password;
                //$this->sendEmail($model, "new-user", "Nuovo account Comune di Ginestra Degli Schiavoni");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', "Ops...something went wrong [USER-100]");
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
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
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * sends new credentials to user.
     * generates a random password 
     * and send it to user.
     * this is used only by admi
     */
    public function actionSendCredentials($id)
    {

        if (!Yii::$app->user->identity->isAdmin()) return;

        $user = $this->findModel($id);

        if (empty($user)) return;

        $password = Utils::generateRandomPassword();
        $user->setPassword($password);

        if ($user->save()) {
            $user->password = $password;
            $this->sendEmail($user, 'new-credentials', "Nuove credenziali su Tenuta Punta Galera");
            Yii::$app->session->setFlash('success', 'Nuova password inviata correttamente');
        } else {
            Yii::$app->session->setFlash('error', 'Ops...c\'è stato qualche problema. [USER-105] <pre>' . json_encode($user->getErrors(), JSON_PRETTY_PRINT) . "</pre>");
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function sendEmail($model, $view, $object)
    {

        if (empty($model)) return false;

        $message = Yii::$app->mailer
            ->compose(
                ['html' => $view],
                ['client' => $model]
            )
            ->setFrom([Yii::$app->params["senderEmail"] => Yii::$app->params["senderName"]])
            ->setTo($model->email)
            ->setSubject($object);

        return $message->send();
    }
}
