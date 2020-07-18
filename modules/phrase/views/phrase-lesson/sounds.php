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
<a href="#" id="stop" class="btn btn-primary">Остановить</a>

<div class="wrapper">
  <div id="id_item" style="display: none;"></div>
  <div class="card" id="engl">not phrase</div>
  <div class="card" id="ru">нет фразы</div>
</div>

<div class="statistics_sounds">
  <p>Всего фраз:  <span id="str_all"><?= $text->stat->phrases->all ?></span></p>
  <p>Озвучено:  <span id="str_sounded">0</span></p>
  <p>Осталось:  <span id="str_rest">0</span></p>
</div>

