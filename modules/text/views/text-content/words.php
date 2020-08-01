<?php

use yii\helpers\{Html, Url};
use yii\grid\GridView;
use app\models\{Word, WordText};
use app\models\Sound;
use app\helpers\BreadcrumbsHelper;

// $this->registerJsFile('@web/js/sort_state.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerJsFile('@web/js/word/studied.js', ['depends' => 'yii\web\YiiAsset']);

$this->title = 'Слова';

$this->params['breadcrumbs'] = BreadcrumbsHelper::category($text->category);
$this->params['navigation'] = BreadcrumbsHelper::text($text->id);

?>

<div class="text-word-index">

    <h1><?= Html::encode($text->title) ?></h1>

    <ul class="statistics">
        <li>Всего слов: <span><?= $text->stat->words->all ?></span></li>
        <li>Выучено слов: <span><?= $text->stat->words->learned ?></span></li>
        <li>Не выучено слов: <span><?= $text->stat->words->not_learned ?></span></li>
    </ul>

    <p class="nav-horizontal">
        <?= Html::a('Угадай', ['/word/lesson/guess', 'text_id' => $text->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Написать', ['word/lesson/write', 'text_id' => $text->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Учить', ['/word/lesson/study', 'text_id' => $text->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Озвучить', ['/word/lesson/sounds', 'text_id' => $text->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Повторять', ['/word/lesson/repeat', 'text_id' => $text->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видео', ['/word/video', 'id' => $text->id], ['class' => 'btn btn-primary']) ?>
        <button id="studied" class="btn btn-primary">Изучены</button>
    </p>

    <div class="nav-vertical">
        <a href="/text-word/state-page?text_id=<?=$text->id?>&page=<?=$page?>">
            <i class="fas fa-graduation-cap" title="выучено все"></i>
        </a>
<!--         <a href="<?=Url::to(['/sound/create-file-strings', 'text_id' => $text->id, 'type' => TYPE_WORD, 'lang' => 'en'])?>">
            <i class="fas fa-file-audio" title="создать файл озвучки"></i>
        </a> -->
        <a href="<?=Url::to(['/sound/add-sounds', 'type' => TYPE_WORD])?>">
            <i class="fas fa-microphone-alt" title="добавить озвучку"></i>
        </a>
        <a href="<?=Url::to(['/word/add-from-files'])?>">
            <i class="fas fa-plus-circle" title="добавить слова"></i>
        </a>
    </div>


<div class="container">
    <h2>Слова текста</h2>           
    <table class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>№</th>
            <th>Engl</th>
            <th>Ru</th>
            <th>State</th>
            <th>Select</th>
            <th>Sound</th>
          </tr>
        </thead>
        <tbody>
            <?php $num = 1; ?>
            <?php if ($text->words): ?>
                <?php foreach ($text->words as $word): ?>
                    <tr>
                        <td><?= $num ?></td>
                        <td><?= $word->engl ?></td>
                        <td><?= $word->ru ?></td>
                        <td>
                            <? $css_class = $word->state->value ? 'green' : 'red'; ?>
                            <?= Html::a($word->state->valueStr, ['/word/set-state', 'id' => $word->id], ['class' => $css_class]) ?>
                        </td>
                        <td>
                            <input type="checkbox" name="state" value="<?= $word->id ?>">
                        </td>
                        <td><?= $word->player('en'); ?></td>
                      </tr>
                  <?php $num++; ?>
                <?php endforeach ?>
            <?php else: ?>
                    <span>слов нет</span>
            <?php endif ?>

        </tbody>
    </table>
</div>

