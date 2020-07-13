<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Sound;
use yii\widgets\LinkPager;
use app\helpers\{ BreadcrumbsHelper, GridViewHelper };

$this->title = 'Фразы';

$this->params['breadcrumbs'] = BreadcrumbsHelper::category($text->category);
$this->params['navigation'] = BreadcrumbsHelper::text($text->id);

  \app\assets\AppAsset::register($this);
?>
<div class="substring-index">

    <h1> <?= Html::encode($this->title) ?> <span><b>Текст:</b> <?= $text->title ?></span></h1>

     <ul class="statistics">
        <li>Всего фраз: <span><?= $text->stat->phrases->all ?></span></li>
        <li>Выучено фраз: <span><?= $text->stat->phrases->leaned ?></span></li>
        <li>Не выучено фраз: <span><?= $text->stat->phrases->not_learned ?></span></li>
    </ul>

    <p>
        <?= Html::a('Разбить на фразы', ['/phrase/break-text', 'text_id' => $text->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Создать файл en', ['/sound/create-file-strings', 'text_id' => $text->id, 'lang' => 'en'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Создать файл ru', ['/sound/create-file-strings', 'text_id' => $text->id, 'lang' => 'ru'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить озвучку en', ['/sound/add-for-phrases', 'text_id' => $text->id, 'lang' => 'en'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить озвучку ru', ['/sound/add-for-phrases', 'text_id' => $text->id, 'lang' => 'ru'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить все фразы', ['/phrase/delete-all', 'text_id' => $text->id], [
            'class' => 'btn btn-danger',
            'data' => ['confirm' => 'Вы действительно хотите удалить все фразы?',],
        ]) ?>
    </p>
    <p>
        <?= Html::a('Учить', ['/phrase/study', 'text_id' => $text->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Озвучить', ['/phrase/sounds', 'text_id' => $text->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Повторять', ['/phrase/repeat', 'text_id' => $text->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <? if ($dataProvider->getModels()): ?>
        
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'engl',

                'ru',

                ['attribute' => 'sound_en', 'format' => 'raw', 'value' => function($model) {return $model->player('en');}],  

                ['attribute' => 'sound_ru', 'format' => 'raw', 'value' => function($model) {return $model->player('ru');}],  

                ['class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function ($action, $model) {
                        if ($action === 'view') return '/phrase/phrase/view?id=' . $model->id;
                        if ($action === 'update') return '/phrase/phrase/update?id=' . $model->id;
                        if ($action === 'delete') return '/phrase/phrase/delete?id=' . $model->id;
                    },
 
                ],
            ],
        ]); ?>

    <? else: ?>
        <div class="alert alert-warning" role="alert">
            У этого текста фраз еще нет
        </div>
    <? endif; ?>

</div>
