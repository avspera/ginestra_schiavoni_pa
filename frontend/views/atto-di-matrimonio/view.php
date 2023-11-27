<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */

$referrer = Yii::$app->request->referrer;

$this->title = "N. " . $model->id . " del " . Utils::formatDate($model->data_matrimonio);
$this->params['breadcrumbs'][] = [
    'label' => 'Atti di matrimonio',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];
\yii\web\YiiAsset::register($this);
?>
<div class="atto-di-matrimonio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (strpos($referrer, "albo-pretorio") !== false) { ?>
            <?= Html::a("Torna indietro", Url::to(["albo-pretorio/index"]), ["class" => "btn btn-xs btn-primary"]) ?>
        <?php } ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'coniuge_uno',
                'value' => function ($model) {
                    if (is_numeric($model->coniuge_uno)) {
                        return Utils::getCittadino($model->coniuge_uno);
                    } else {
                        return $model->coniuge_uno;
                    }
                },
                'format' => "raw",
            ],
            'padre_coniuge_uno',
            'madre_coniuge_uno',
            [
                'attribute' => 'titolo_studio_coniuge_uno',
                'value' => function ($model) {
                    return $model->getTitoloStudio($model->titolo_studio_coniuge_uno);
                }
            ],
            [
                'attribute' => 'posizione_professionale_coniuge_uno',
                'value' => function ($model) {
                    return $model->getPosizioneProfessionale($model->posizione_professionale_coniuge_uno);
                }
            ],
            [
                'attribute' => 'condizione_non_professionale_coniuge_uno',
                'value' => function ($model) {
                    return $model->getCondizioneNonProfessionale($model->condizione_non_professionale_coniuge_uno);
                }
            ],
            [
                'attribute' => 'coniuge_due',
                'value' => function ($model) {
                    if (is_numeric($model->coniuge_due)) {
                        return Utils::getCittadino($model->coniuge_due);
                    } else {
                        return $model->coniuge_due;
                    }
                },
                'format' => "raw"
            ],
            'padre_coniuge_due',
            'madre_coniuge_due',
            [
                'attribute' => 'titolo_studio_coniuge_due',
                'value' => function ($model) {
                    return $model->getTitoloStudio($model->titolo_studio_coniuge_due);
                }
            ],

            [
                'attribute' => 'posizione_professionale_coniuge_due',
                'value' => function ($model) {
                    return $model->getPosizioneProfessionale($model->posizione_professionale_coniuge_due);
                }
            ],

            [
                'attribute' => 'condizione_non_professionale_coniuge_due',
                'value' => function ($model) {
                    return $model->getCondizioneNonProfessionale($model->condizione_non_professionale_coniuge_due);
                }
            ],
            'data_matrimonio:date',
            [
                'attribute' => 'residenza',
                'value' => function ($model) {
                    if (is_numeric($model->residenza)) {
                        return Utils::getResidenza($model->residenza);
                    } else {
                        return $model->residenza;
                    }
                },
                'format' => "raw"
            ],
            'luogo_matrimonio',
            [
                'attribute' => 'tipo_rito',
                'value' => function ($model) {
                    return $model->getTipoRito();
                }
            ],
            [
                'attribute' => 'regime_matrimoniale',
                'value' => function ($model) {
                    return $model->getRegimeMatrimoniale();
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'published_by',
                'value' => function ($model) {
                    return Utils::getCreatedBy($model->published_by);
                }
            ],
        ],
    ]) ?>

    <div class="row" style="margin-top:10px;">
        <p class="text-center"><?= Html::a("Esprimi il tuo giudizio", Url::to(["valutazione-servizio/create"]), ["class" => "btn btn-success"]) ?></p>
    </div>
</div>