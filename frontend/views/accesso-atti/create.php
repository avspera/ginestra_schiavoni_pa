<?php


/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */

$this->title = 'Richiedi Accesso agli Atti';
$this->params['breadcrumbs'][] = [
    'label' => 'Servizi',
    'url' => ['index'],
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

$this->params['breadcrumbs'][] = [
    'label' => 'Accesso agli atti',
    'url' => ['index'],
    'template' => "<li class='breadcrumb-item'><span class='separator'>/</span>{link}</li>",
];

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'template' => "<li class='breadcrumb-item active'><span class='separator'>/</span>{$this->title}</li>",
];

?>
<div class="accesso-atti-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>