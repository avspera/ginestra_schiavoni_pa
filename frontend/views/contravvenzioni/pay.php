<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\components\Utils;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */

$this->title = "Contravvenzione #" . $model->id . " del " . Utils::formatDate($model->data_accertamento);
$this->params['breadcrumbs'][] = [
    'label' => 'Contravvenzioni',
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
    'url' => ["index"]
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

?>
<div class="contravvenzione-view">

    <div class="row">
        <div class="col-12">
            <!--start card-->
            <div class="card-wrapper card-space">
                <div class="card card-bg ">
                    <div class="card-header">
                        <h1><?= Html::encode($this->title) ?></h1>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        if (!$model->payed) {
                            echo '<a href="' . Url::to(["pay", "id" => $model->id]) . '" class="btn btn-xs btn-success btn-xs btn-icon" role="button" aria-disabled="true">
                                <svg class="icon icon-white">
                                    <use
                                    xlink:href="/bootstrap-italia/svg/sprites.svg#it-card"
                                    ></use>
                                </svg>
                                <span>Paga con pagoPA</span>
                                </a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>