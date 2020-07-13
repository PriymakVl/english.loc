<?php 

use yii\helpers\Html;
use app\helpers\BreadcrumbsHelper;
use app\models\sound\Sound;

$this->registerJsFile('@web/js/word/repeat.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerCssFile('@web/css/word/repeat.css');

$this->title = 'Повторение слов';

$this->params['navigation'] = BreadcrumbsHelper::text($text->id);

?>

<h1><?= $this->title ?> <span><b>текст:</b> <?= $text->title ?></span></h1>

<button id="turn_lang" class="btn btn-primary">English</button>

<span id="count-words">Количество слов: <?= count($words) ?></span>


<div class="wrapper">
  <? if ($words): ?>
    <?php foreach ($words as $word): ?>
      <div class="card">
        <div class="card__content" >
          <span title="<?=$word->engl?>"><?= $word->ru ?></span>
        </div>
        <div class="card__action">
          <i class="fas fa-eye-slash card__hide" title="не показывать"></i>
          <i class="fas fa-check-circle card__learned" word_id="<?=$word->id?>" title="выучено"></i>
          <i class="fas fa-play-circle card__play" onclick="sound_play(this);" sound="<?= $word->sound->en ?>" title="озвучить"></i>
          <?php if ($word->phrases): ?>
             <i class="fas fa-quote-right" engl="<?= $word->engl ?>" ru="<?= $word->ru ?>" onclick="showPhrases(this);" data-phrases="<?=Sound::makeStringForPlayer($word->phrases, false);?>" title="фразы"></i>
          <?php endif ?>
        </div>
      </div>
    <?php endforeach ?>
  <? else: ?>
    <div class="alert alert-warning" role="alert">
      Слов нет
    </div>
  <? endif; ?>
</div>

<!-- HTML-код модального окна c фразами -->
<div id="myModalBox" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"></h4>
      </div>
      <!-- Основное содержимое модального окна -->
      <div class="modal-body"></div>
    </div>
  </div>
</div>

<script>
  function showPhrases(elem)
  {
    let phrases_str = $(elem).data('phrases');
    phrases_arr = phrases_str.split(';');
    phrases_list = '';
    for (let i = 0; i < phrases_arr.length; i++) {
      if (!phrases_arr[i]) continue;
      item = phrases_arr[i].split(':');
      phrases_list += '<h3 title="' + item[3] + '"><span>' + item[2] + '</span>';
      if (item[0]) phrases_list += '<i class="fas fa-play-circle player-btn" style="margin-left: 10px;" onclick="sound_play(this);" sound="' + item[0] + '"></i>';
      phrases_list += '</h3>';
    }
    let engl = $(elem).attr('engl');
    let ru = $(elem).attr('ru');
    $('.modal-title').text(engl + ' (' + ru + ')');
    $('.modal-body').html(phrases_list);
    $('#myModalBox').modal('show');
  }
</script>

