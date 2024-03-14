<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\ParcheggioResidenti $model */

$cittadino = is_numeric($model->cittadino) ? Utils::getCittadino($model->cittadino) : $model->cittadino;
$this->title = $model->id . " di " . $cittadino;
$this->params['breadcrumbs'][] = [
    'label' => 'Parcheggio residenti',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];
?>
<div class="parcheggio-residenti-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>
        <?php if (!$model->approved) { ?>
            <?= Html::a('Approva', ['approve', 'id' => $model->id], ['class' => 'btn btn-xs btn-success']) ?>
        <?php } ?>
        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-xs btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'cittadino',
                'value' => function ($model) {
                    if (is_numeric($model->cittadino)) {
                        return Utils::getCittadino($model->cittadino);
                    } else {
                        return $model->cittadino;
                    }
                }
            ],
            'indirizzo',
            'qnt_auto',
            'targa',
            'veicolo',
            [
                'attribute' => 'price',
                'value' => function ($model) {
                    return Utils::formatCurrency($model->price);
                }
            ],
            [
                'attribute' => 'durata',
                'value' => function ($model) {
                    return $model->getDurata();
                }
            ],
            [
                'attribute' => 'payed',
                'value' => $model->payed ? "SI" : "NO"
            ],
            'data_rilascio:date',
            [
                'attribute' => 'carta_identita',
                'value' => function ($model) {
                    if (!empty($model->carta_identita)) {
                        $html = "<ul class='upload-file-list'>";
                        $attachments = json_decode($model->carta_identita);
                        foreach ($attachments as $item) {
                            $fullPath = Yii::getAlias("@frontend/web/") . "uploads/parcheggio-residenti/" . $item;
                            $html .= '
                            <li class="upload-file success">
                              <svg class="icon icon-sm" aria-hidden="true"><use href="/bootstrap-italia/svg/sprites.svg#it-file"></use></svg>
                              <p>
                                <span class="visually-hidden">File:</span>' . Html::a($item, Url::to($fullPath)) . '
                              </p>
                            </li>';
                        }
                        $html .= "</ul>";

                        return $html;
                    }

                    return "-";
                },
                'format' => "raw"
            ],
            [
                'attribute' => 'carta_circolazione',
                'value' => function ($model) {
                    if (!empty($model->carta_circolazione)) {
                        $html = "<ul class='upload-file-list'>";
                        $attachments = json_decode($model->carta_circolazione);
                        foreach ($attachments as $item) {
                            $fullPath = Yii::getAlias("@frontend/web/") . "uploads/parcheggio-residenti/" . $item;
                            $html .= '
                            <li class="upload-file success">
                              <svg class="icon icon-sm" aria-hidden="true"><use href="/bootstrap-italia/svg/sprites.svg#it-file"></use></svg>
                              <p>
                                <span class="visually-hidden">File:</span>' . Html::a($item, Url::to($fullPath)) . '
                              </p>
                            </li>';
                        }
                        $html .= "</ul>";

                        return $html;
                    }

                    return "-";
                },
                'format' => "raw"
            ],
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => Utils::getCreatedBy($model->created_by)
            ],
            [
                'attribute' => 'updated_by',
                'value' => Utils::getCreatedBy($model->updated_by)
            ],

        ],
    ]) ?>

    <div class="row" style="margin-top:10px;">
        <p class="text-center"><?= Html::a("Esprimi il tuo giudizio", Url::to(["valutazione-servizio/create"]), ["class" => "btn btn-success"]) ?></p>
    </div>
</div>