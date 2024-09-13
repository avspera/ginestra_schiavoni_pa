<?php

namespace frontend\controllers;

use common\models\AccessoAtti;
use common\models\AttoDiMatrimonio;
use common\models\Contravvenzione;
use common\models\ParcheggioResidenti;
use Yii;
use common\models\Cittadino;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

/**
 * UsersController implements the CRUD actions for User model.
 */
class CittadinoController extends Controller
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
                            'create',
                            'view',
                        ],
                        'allow' => true,
                        'allow' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $accesso_atti   = AccessoAtti::find()
            ->select(["id", "numero_protocollo", "stato_richiesta", "data_creazione as date", new \yii\db\Expression("'Accesso agli atti' as label"), new \yii\db\Expression("'accesso-atti/view' as url")])
            ->where(["id_cittadino" => $id])
            ->limit(3)
            ->orderBy(["data_creazione" => SORT_ASC])
            ->asArray()
            ->all();

        $contravvenzioni        = Contravvenzione::find()
            ->select(["id", "stato as stato_richiesta", "created_at as date", new \yii\db\Expression("'Contravvenzione' as label"), new \yii\db\Expression("'contravvenzioni/view' as url")])
            ->where(["id_cittadino" => $id])
            ->limit(3)
            ->orderBy(["created_at" => SORT_ASC])
            ->asArray()
            ->all();

        $atti_di_matrimonio     = AttoDiMatrimonio::find()
            ->select(["id", "numero_protocollo", "stato as stato_richiesta", "created_at as date", new \yii\db\Expression("'Atto di matrimonio' as label"), new \yii\db\Expression("'atto-di-matrimonio/view' as url")])
            ->where(["id_cittadino" => $id])
            ->limit(3)
            ->orderBy(["created_at" => SORT_ASC])
            ->asArray()
            ->all();

        $parcheggio_residenti   = ParcheggioResidenti::find()
            ->select(["id", "numero_protocollo", "stato as stato_richiesta", "created_at as date", new \yii\db\Expression("'Parcheggio per residenti' as label"), new \yii\db\Expression("'parcheggio-residenti/view' as url")])
            ->where(["id_cittadino" => $id])
            ->limit(3)
            ->orderBy(["created_at" => SORT_ASC])
            ->asArray()
            ->all();

        $latestAttivita = array_merge($accesso_atti, $contravvenzioni, $atti_di_matrimonio, $parcheggio_residenti);

        // Ordina i risultati per data (decrescente)
        usort($latestAttivita, function ($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });

        return $this->render('view', [
            'model'                 => $model,
            'accesso_atti'          => $accesso_atti,
            'contravvenzioni'       => $contravvenzioni,
            'atti_di_matrimonio'    => $atti_di_matrimonio,
            'parcheggio_residenti'  => $parcheggio_residenti,
            'latest_attivita'        => $latestAttivita
        ]);
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
        if (($model = Cittadino::findOne(['id' => $id])) !== null) {
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
