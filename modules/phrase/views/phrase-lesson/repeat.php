<?php 

	use yii\helpers\Html;
  use app\helpers\BreadcrumbsHelper;

	$this->registerJsFile('@web/js/repeat_cards.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerJsFile('@web/js/select_subtext.js', ['depends' => 'yii\web\YiiAsset']);

$this->title = 'Повторение фраз';

$this->params['navigation'] = BreadcrumbsHelper::text($text->id);

$this->registerCssFile('@web/css/phrase/repeat.css');
\app\assets\AppAsset::register($this);
?>

<h1>Повторение фраз <span><b>Текст:</b> <?= $text->title ?></span></h1>

<button id="turn_lang" class="btn btn-primary">Russion</button>

<span>Количество фраз: <?= $text->stat->phrases->all ?></span>

<div class="wrapper">
  <? if ($phrases): ?>
    <?php foreach ($phrases as $phrase): ?>
      <div class="card">
        <div class="card__content" >
          <span title="<?=$phrase->ru?>"><?= $phrase->engl ?></span>
        </div>
        <div class="card__action">
          <i class="fas fa-eye-slash card__hide" title="не показывать"></i>
          <?php if ($phrase->sound->en): ?>
            <i class="fas fa-play-circle card__play" onclick="sound_play(this);" sound="<?= $phrase->sound->en ?>"></i>
          <?php endif ?>
        </div>
      </div>
    <?php endforeach ?>
  <? else: ?>
    <div class="alert alert-warning" role="alert">
      Фраз нет
    </div>
  <? endif; ?>
</div>

