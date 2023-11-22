<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\AttoDiMatrimonio $model */

$this->title = "Atto N. " . $model->id . " del " . Utils::formatDate($model->created_at);
$this->params['breadcrumbs'][] = [
    'label' => 'Atti di Matrimonio',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'>" . $this->title . "</li>",
];

\yii\web\YiiAsset::register($this);
?>
<div class="atto-di-matrimonio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>
        <?php if (!$model->approved) : ?>
            <?= Html::a('Approva', ['approve', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?php endif; ?>
        <?php if (!$model->published) { ?>
            <?= Html::a('Pubblica', ['publish', 'id' => $model->id], ['class' => 'btn btn-xs btn-success']) ?>
        <?php } else { ?>
            <?= Html::a('Vedi in albo pretorio', Url::to(['/albo-pretorio/view', 'id' => $model->id_albo_pretorio]), ['class' => 'btn btn-xs btn-success']) ?>
        <?php } ?>

        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-xs btn-danger',
            'data' => [
                'confirm' => 'Sicuro di voler cancellare questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => "published",
                'value' => function ($model) {
                    return $model->published ? "SI" : "NO";
                }
            ],
            [
                'attribute' => "approved",
                'value' => function ($model) {
                    return $model->approved ? "SI" : "NO";
                }
            ],
            [
                'attribute' => 'id_coniuge_uno',
                'value' => function ($model) {
                    return Html::a(Utils::getCittadino($model->id_coniuge_uno), Url::to(["cittadino/view", "id" => $model->id_coniuge_uno]));
                },
                'format' => "raw"
            ],
            [
                'attribute' => 'id_coniuge_due',
                'value' => function ($model) {
                    return Html::a(Utils::getCittadino($model->id_coniuge_due), Url::to(["cittadino/view", "id" => $model->id_coniuge_due]));
                },
                'format' => "raw"
            ],
            'data_matrimonio:date',
            [
                'attribute' => 'id_residenza',
                'value' => function ($model) {
                    return Utils::getResidenza($model->id_residenza);
                },
                'format' => "raw"
            ],
            'padre_coniuge_uno',
            'madre_coniuge_uno',
            'padre_coniuge_due',
            'madre_coniuge_due',
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
            [
                'attribute' => 'titolo_studio_coniuge_uno',
                'value' => function ($model) {
                    return $model->getTitoloStudio($model->titolo_studio_coniuge_uno);
                }
            ],
            [
                'attribute' => 'titolo_studio_coniuge_due',
                'value' => function ($model) {
                    return $model->getTitoloStudio($model->titolo_studio_coniuge_due);
                }
            ],
            [
                'attribute' => 'posizione_professionale_coniuge_uno',
                'value' => function ($model) {
                    return $model->getPosizioneProfessionale($model->posizione_professionale_coniuge_uno);
                }
            ],
            [
                'attribute' => 'posizione_professionale_coniuge_due',
                'value' => function ($model) {
                    return $model->getPosizioneProfessionale($model->posizione_professionale_coniuge_due);
                }
            ],
            [
                'attribute' => 'condizione_non_professionale_coniuge_uno',
                'value' => function ($model) {
                    return $model->getCondizioneNonProfessionale($model->condizione_non_professionale_coniuge_uno);
                }
            ],
            [
                'attribute' => 'condizione_non_professionale_coniuge_due',
                'value' => function ($model) {
                    return $model->getCondizioneNonProfessionale($model->condizione_non_professionale_coniuge_due);
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'updated_by',
                'value' => function ($model) {
                    return Utils::getCreatedBy($model->updated_by);
                }
            ],
            [
                'attribute' => 'approved_by',
                'value' => function ($model) {
                    return Utils::getCreatedBy($model->approved_by);
                }
            ],
            [
                'attribute' => 'published_by',
                'value' => function ($model) {
                    return Utils::getCreatedBy($model->published_by);
                }
            ],
        ],
    ]) ?>

</div>