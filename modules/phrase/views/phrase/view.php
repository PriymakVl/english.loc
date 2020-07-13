<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Sound;
use app\helpers\BreadcrumbsHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Phrase */

$this->title = 'Фраза';

$this->params['breadcrumbs'] = BreadcrumbsHelper::category($model->text->category);
$this->params['navigation'] = BreadcrumbsHelper::text($model->text->id);

\yii\web\YiiAsset::register($this);

?>
<div class="phrase-view">

    <h1>Фраза</h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Prev', ['view', 'text_id' => $text->id, 'id' => $model->prev($text->phrases)->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Next', ['view', 'text_id' => $text->id, 'id' => $model->next($text->phrases)->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Learned', ['/phrase/set-state', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'engl',
            
            'ru',
            
            ['attribute' => 'sound_en', 'format' => 'raw', 'value' => function($model) {return $model->player('en');}],

            ['attribute' => 'sound_ru', 'format' => 'raw', 'value' => function($model) {return $model->player('ru');}],

            ['attribute' => 'substr', 'format' => 'html',
                'value' => function($model) {return $model->templateSubstr();}, 
            ],

            ['attribute' => 'prev', 'format' => 'html', 'value' => function($model) { 
                return $model->prev($model->text->phrases)->engl.'<br>'.$model->prev($model->text->phrases)->ru; }
            ],

            ['attribute' => 'next', 'format' => 'html', 'value' => function($model) { 
                return $model->next($model->text->phrases)->engl.'<br>'.$model->next($model->text->phrases)->ru; }
            ],
        ],
    ]) ?>

    <h2>Форма для добавления подфраз</h2>

    <?php $form = ActiveForm::begin(['action' => '/phrase/create-sub']); ?>

        <?= $form->field($substr, 'engl')->textarea(['rows' => '1']) ?>

        <?= $form->field($substr, 'ru')->textarea(['rows' => '1']) ?>

        <?= $form->field($substr, 'text_id')->hiddenInput(['value' => $model->text_id])->label(false) ?>

        <?= $form->field($substr, 'parent_id')->hiddenInput(['value' => $model->id])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
