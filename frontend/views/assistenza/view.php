<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\components\Utils;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Assistenza $model */

$this->title = $model->id . " del " . Utils::formatDate($model->created_at);
$this->params['breadcrumbs'][] = [
    'label' => 'Assistenza',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>" . $this->title . "</li>",
];

?>
<div class="assistenza-view">

    <div class="row">
        <div class="col-6 col-md-6 col-sm-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-6 col-md-6 col-sm-6">
            <h3>Risposte</h3>
        </div>
    </div>

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-primary']) ?>
        <?php if ($model->stato_richiesta == $model->stato_richiesta_flipped["pending"]) { ?>
            <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-xs btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </p>

    <div class="row">
        <div class="col-6 col-md-6 col-sm-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'email_richiedente:email',
                    'nome_richiedente',
                    'cf_richiedente',
                    [
                        'attribute' => 'motivo_richiesta',
                        'value' => function ($model) {
                            return $model->getMotivoRichiesta();
                        }
                    ],
                    'data_appuntamento:date',
                    [
                        'attribute' => 'stato_richiesta',
                        'value' => function ($model) {
                            return $model->getStatoRichiesta();
                        }
                    ],
                    'note:ntext',
                    'created_at:date',
                    'updated_at:datetime',
                    [
                        'attribute' => 'updated_by',
                        'value' => function ($model) {
                            return Utils::getCreatedBy($model->updated_by);
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-6 col-md-6 col-sm-6">
            <?= GridView::widget([
                'dataProvider' => $replies,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'messaggio:ntext',
                    'created_at:date',
                ],
            ]); ?>

            <h3>Aggiungi risposta</h3>
            <div class="assistenza-reply-form">

                <?php $form = ActiveForm::begin([
                    'action' => ["assistenza-reply/create"],
                    'enableClientValidation' => true,
                ]); ?>

                <?= $form->field($replyModel, 'id_assistenza')->hiddenInput(["value" => $model->id])->label(false) ?>

                <div class="form-group">
                    <label class="active control-label" for="exampleFormControlTextarea1">Messaggio</label>
                    <textarea id="assistenzareply-messaggio" name="AssistenzaReply[messaggio]" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Invia', ['class' => 'btn btn-xs btn-success float-end']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

    <div class="row" style="margin-top:10px;">
        <p class="text-center"><?= Html::a("Esprimi il tuo giudizio", Url::to(["valutazione-servizio/create"]), ["class" => "btn btn-success"]) ?></p>
    </div>

</div>