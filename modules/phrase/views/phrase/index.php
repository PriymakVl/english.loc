<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhraseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фразы';
$this->params['breadcrumbs'][] = $this->title;

  \app\assets\AppAsset::register($this);
?>
<div class="phrase-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            'engl',

            'ru',

            'text_id',

            ['attribute' => 'sound_en', 'format' => 'raw', 'value' => function($model) {return $model->player('en');}],

            ['attribute' => 'sound_ru', 'format' => 'raw', 'value' => function($model) {return $model->player('ru');}],

            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
