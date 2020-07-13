<?php 
use yii\helpers\Html;

$this->registerJsFile('@web/js/sounds_words_video.js', ['depends' => 'yii\web\YiiAsset']);
$this->registerCssFile('@web/css/word/video.css');

?>


<div class="container">
	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<div class="card" id="engl">нет слова</div>
		</div>
		<div class="col-lg-3"></div>
	</div>
  	<div class="row">
  		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<div class="card" id="ru">нет слова</div>
		</div>
		<div class="col-lg-3"></div>
	</div>
</div>

<div class="statistics_sounds">
  <p>Всего слов:  <span id="word_all"><?=count($text->words)?></span></p>
  <p>Озвучено:  <span id="word_sounded">0</span></p>
  <p>Осталось:  <span id="word_rest">0</span></p>
</div>

<button id="start" data-sounds-str="<?= $sounds_str ?>">Start</button>


