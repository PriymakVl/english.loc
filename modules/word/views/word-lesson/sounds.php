<?php 

use yii\helpers\Html;
use app\helpers\BreadcrumbsHelper;

$this->registerCssFile('@web/css/word/sounds.css');
$this->registerJsFile('@web/js/sounds_words.js', ['depends' => 'yii\web\YiiAsset']);

$this->title = 'Озвучка слов';

$this->params['navigation'] = BreadcrumbsHelper::text($text->id);

?>


<p>текст: <?= $text->title ?></p>

<?= Html::a('Начать', ['#'], ['id' => 'start', 'data-sounds-str' => $sounds_str, 'class' => 'btn btn-primary']) ?>
<?= Html::a('Остановить', ['#'], ['id' => 'stop', 'text_id' => $text->id, 'class' => 'btn btn-primary']) ?>


<div class="wrapper">
  <!-- <div id="id_item" style="display: none;"></div> -->
  <div class="card" id="engl">нет слова</div>
  <div class="card" id="ru">нет слова</div>
</div>

<div class="statistics_sounds">
  <p>Всего слов:  <span id="word_all"></span></p>
  <p>Озвучено:  <span id="word_sounded"></span></p>
  <p>Осталось:  <span id="word_rest"></span></p>
</div>

