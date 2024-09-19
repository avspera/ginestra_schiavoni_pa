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