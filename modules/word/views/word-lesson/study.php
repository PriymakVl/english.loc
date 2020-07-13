<?php

use yii\helpers\Html;
use app\models\Word;
use app\helpers\BreadcrumbsHelper;

$this->registerJsFile('@web/js/select_subtext.js', ['depends' => 'yii\web\YiiAsset']);

$this->title = 'Учить слова';

$this->params['navigation'] = BreadcrumbsHelper::text($text->id);

?>

<style type="text/css">
    h2 span{
        margin-right: 30px;
    }
    h2 span:first-child:hover {
        cursor: pointer;
    }
    .hidden {
        display: none;
    }
    .table {
        margin-top: 30px;
    }
    .fa-globe-americas:hover {
        color: red;
    }

    .statistics-wrp {
        display: flex;
    }
    .select-subtext {
        margin-left: 100px;
    }
</style>

<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>текст: <?= $text->title ?></p>

    <div class="statistics-wrp">
        <ul class="statistics">
            <li>Всего слов: <span><?= count($words); ?></span></li>
            <li>Пройдено слов: <span><?= $word->passed($words) ?></span></li>
            <li>Осталось слов: <span><?= $word->rest($words) ?></span></li>
        </ul>
    </div>

    <p>
        <?= Html::a('Prev', ['study', 'text_id' => $text->id, 'word_id' => $word->prev($words)->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Next', ['study', 'text_id' => $text->id, 'word_id' => $word->next($words)->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Learned', ['/word/set-state', 'id' => $word->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['/word/update', 'id' => $word->id], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <h2 title="<?= $word->ru ?>">
        <span onclick="translate_word.classList.toggle('hidden');"><?=$word->engl?></span>
        <span class="text-success hidden" id="translate_word"><?=$word->ru?></span>
        <?= $word->makePlayer() ?>
    </h2>

    <h2 id="answer" class="hidden">Перевод: </h2>

    <? if ($word->phrases): ?>
        <? $num = 1; ?>
        <table class="table table-bordered table-striped table-responsive">
            <tr>
                <th>#</th>
                <th>Фразы</th>
                <th>Озвучка</th>
            </tr>
            <? foreach ($word->phrases as $phrase): ?>
                <tr style="font-size: 1.2em;cursor:pointer;">
                    <td><?= $num; ?></td>
                    <td title="<?= $phrase->ru ?>">
                        <i class="fas fa-globe-americas" onclick="change_text(this);"></i>
                        <span><?= $phrase->engl ?></span>
                    </td>
                    <td>
                        <?= $phrase->makePlayer() ?>
                    </td>
                </tr>
                <? $num++; ?>
            <? endforeach; ?>
        </table>
    <? endif; ?>

<!-- js script -->
<script type="text/javascript">
function change_text(icon) {
    let parent = icon.parentNode;
    text = parent.innerText;
    translate = parent.getAttribute('title');
    parent.children[1].innerText = translate;
    parent.setAttribute('title', text);
}

</script>
