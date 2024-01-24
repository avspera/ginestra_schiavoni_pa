<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Contravvenzione $model */
/** @var ActiveForm $form */
?>
<div class="contravvenzioni-_form">

    <?php $form = ActiveForm::begin([
        'id' => 'searchForm',
        'enableAjaxValidation' => true,
    ]); ?>

    <div class="row">
        <div class="form-group col-md-3">
            <label class="active control-label" for="contravvenzione-amount">Codice Fiscale</label>
            <input type="text" required maxlength="16" name="Contravvenzione[cf]" id="contravvenzioni-cf" value="<?= $model->cf ?>" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label class="active control-label" for="contravvenzione-articolo_codice">Identificativo univoco</label>
            <input type="text" required name="Contravvenzione[id_univoco_versamento]" id="contravvenzioni-id_univoco_versamento" value="<?= $model->id_univoco_versamento ?>" class="form-control">
        </div>
        <div class="form-group col-md-3"><?= Html::button('Cerca', ['class' => 'btn btn-xs btn-primary', 'onclick' => "search()"]) ?></div>
    </div>

    <div class="row">
        <div id="result-message"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- contravvenzioni-_form -->

<script>
    function search() {
        let cf = $("#contravvenzioni-cf").val();
        let iuv = $("#contravvenzioni-id_univoco_versamento").val();

        if (cf.length == 0 || iuv.length == 0) return false;

        $.ajax({
            url: '<?= Url::to(["contravvenzioni/search"]) ?>',
            type: 'get',
            dataType: 'json',
            data: {
                cf: cf,
                iuv: iuv
            },
            success: function(data) {
                if (data.status == 100) {
                    let html = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Attenzione!</strong> ${data.msg}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>`;
                    $("#result-message").append(html);
                    return false;
                }

                
            },
            error: function(richiesta, stato, errori) {
                alert("Attenzione: " + stato);
            }
        });
    }
</script>