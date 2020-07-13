<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Добавить слова';

?>


<div class="word-text-form">

	<h1><?= $this->title ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    	<?= $form->field($model, 'file_ru')->fileInput() ?>

    	<?= $form->field($model, 'file_en')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить слова', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
