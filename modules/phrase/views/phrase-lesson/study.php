<?php

use yii\helpers\Html;
use app\models\Word;
use app\helpers\BreadcrumbsHelper;

$this->title = 'Изучение фразы';

$this->params['navigation'] = BreadcrumbsHelper::text($text->id);

$this->registerCssFile('@web/css/phrase/study.css');
?>

<div class="container">

    <h1>
        <?= Html::encode($this->title) ?> 
        <span><b>текст:</b> <?= $text->title ?></span> 
    </h1>

    <div class="statistics-wrp">
        <ul class="statistics">
            <li>Всего фраз: <span><?= $text->stat->phrases->all ?></span></li>
            <li>Пройдено фраз: <span><?= $phrase->passed($text->phrases) ?></span></li>
            <li>Осталось фраз: <span><?= $phrase->rest($text->phrases) ?></span></li>
        </ul>
    </div>

    <p>
        <?= Html::a('Prev', ['study', 'text_id' => $text->id, 'phrase_id' => $phrase->prev($phrases)->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Next', ['study', 'text_id' => $text->id, 'phrase_id' => $phrase->next($phrases)->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Learned', ['/phrase/set-state', 'id' => $phrase->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['/phrase/update', 'id' => $phrase->id], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <p class="prev-next-wrp">
        <b>Предыдущая фраза:</b>
        <span title="<?= $phrase->prev($phrases)->ru ?>"><?= $phrase->prev($phrases)->engl ?></span>
        <br><br>
        <b>Следующая фраза:</b>
        <span title="<?= $phrase->next($phrases)->ru ?>"><?= $phrase->next($phrases)->engl ?></span>
    </p>

    <h2 title="<?= $phrase->ru ?>">
        <span onclick="translate_word.classList.toggle('hidden');"><?=$phrase->engl?></span>
        <?= $phrase->makePlayer() ?>
        <br>
        <span class="text-success hidden" id="translate_word"><?=$phrase->ru?></span>
    </h2>

    <h2 id="answer" class="hidden">Перевод: </h2>


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
