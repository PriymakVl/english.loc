<?php 

	use yii\helpers\Html;
  use app\helpers\BreadcrumbsHelper;

	$this->registerJsFile('@web/js/sounds_strings.js', ['depends' => 'yii\web\YiiAsset']);
  $this->registerCssFile('@web/css/phrase/sounds.css');
  \app\assets\AppAsset::register($this);

$this->title = 'Озвучка фраз';

$this->params['breadcrumbs'] = BreadcrumbsHelper::text($text->id);

?>

<h1>Озвучка фраз  <span><b>Текст:</b> <?= $text->title ?></span></h1>

<a href="#" id="start" data-strings="<?= $sounds_str ?>" class="btn btn-primary">Начать</a>
<a href="#" id="stop" id_text="<?= $id_text ?>" class="btn btn-primary">Остановить</a>

<div class="wrapper">
  <div id="id_item" style="display: none;"></div>
  <div class="view" id="engl">not phrase</div>
  <!-- <button id="learned" class="btn btn-success">Выучено <span>(0)</span></button> -->
  <div class="view" id="ru">нет фразы</div>
</div>

<div class="statistics_sounds">
  <p>Всего фраз:  <span id="str_all"><?= $text->stat->phrases->all ?></span></p>
  <p>Озвучено:  <span id="str_sounded">0</span></p>
  <p>Осталось:  <span id="str_rest">0</span></p>
</div>

