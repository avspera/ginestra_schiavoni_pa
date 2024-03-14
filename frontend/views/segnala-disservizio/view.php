<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\SegnalazioneDisservizio $model */

$this->title = $model->id . " del " . Utils::formatDate($model->created_at);
$this->params['breadcrumbs'][] = [
    'label' => 'Segnalazione disservizio',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];
?>
<div class="segnalazione-disservizio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Stampa', 'javascript:printPage()', ['class' => 'btn btn-xs btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome_richiedente',
            'cf_richiedente',
            'email_richiedente:email',
            [
                'attribute' => 'id_tipologia',
                'value' => function ($model) {
                    return $model->getTipologia();
                }
            ],
            'created_at:date',
            'note:ntext',
            [
                'attribute' => 'attachments',
                'value' => function ($model) {
                    if (!empty($model->attachments)) {
                        $html = "<ul class='upload-file-list'>";
                        $attachments = json_decode($model->attachments);
                        foreach ($attachments as $item) {
                            $fullPath = Yii::getAlias("@frontend/web/") . "uploads/albo-pretorio/" . $item;
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
        ],
    ]) ?>

    <div class="row" style="margin-top:10px;">
        <p class="text-center"><?= Html::a("Esprimi il tuo giudizio", Url::to(["valutazione-servizio/create"]), ["class" => "btn btn-success"]) ?></p>
    </div>
</div>

<script>
    function printPage() {
        window.print();
    }
</script>