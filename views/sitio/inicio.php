<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
Hola Usuario

<?php

    if(isset($mensaje)){
        echo HTml::tag('div', Html::encode($mensaje), ['class'=>'alert alert-success']);
    }

?>

<?php $formulario=ActiveForm::begin(); ?>

<?=  $formulario->field($model,'valora') ?>

<?=  $formulario->field($model,'valorb') ?>

<div class="form-group">
    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>