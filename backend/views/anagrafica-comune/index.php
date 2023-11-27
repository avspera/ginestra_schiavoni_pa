<?php

use common\models\AnagraficaComune;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AnagraficaComuneSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Anagrafica Comune';
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
]; ?>
<div class="anagrafica-comune-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->identity->isAdmin()) { ?>
        <p>
            <?= Html::a('Aggiungi Anagrafica Comune', ['create'], ['class' => 'btn btn-xs btn-success']) ?>
        </p>
    <?php } ?>

    <div class="table table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'email:email',
                'pec',
                'centralino',
                'via',
                'civico',
                'comune',
                [
                    'class' => ActionColumn::className(),
                    'template' => '{view} {update}'
                ],
            ],
        ]); ?>
    </div>

</div>