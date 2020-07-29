<?php

namespace app\modules\word\controllers;

use Yii;
use yii\helpers\{ArrayHelper, Url};
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\{ActiveDataProvider, Pagination};
use app\modules\text\models\{Text};
use app\modules\word\models\ {Word, WordSearch};
use app\modules\phrase\models\ {Phrase};
use app\models\{State};
use app\models\sound\Sound;

class WordLessonController extends \app\controllers\BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    // 'delete' => ['POST'],
                ],
            ],
        ];
    }


    // public function actionGuess($id_text)
    // {
    //     $text = Text::findOne($id_text);
    //     $query = TextWord::find()->where(['id_text' => $id_text, 'status' => STATUS_ACTIVE]);
    //     $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
    //     $words = $query->offset($pages->offset)->limit($pages->limit)->all();
    //     $engl = $words; $ru = $words; shuffle($ru);
    //     return $this->render('guess', compact('engl', 'ru', 'pages', 'text'));
    // }

    // public function actionWrite($id_text, $index = 0)
    // {
    //     $text = Text::findOne($id_text);
    //     $item = TextWord::getByIndex($id_text, $index);
    //     return $this->render('write', compact('text', 'item', 'index'));
    // }

    public function actionStudy($text_id, $word_id = false)
    {
        Url::remember();
        $text = Text::findOne($text_id);
        $words = State::sort($text->words);
        $word = $word_id ? Word::findOne($word_id) : $words[0];
        return $this->render('study', compact('text', 'word', 'words'));
    }

    public function actionSounds($text_id = false) 
    {
        if ($text_id) $words = Text::findOne($text_id)->words;
        else $words = Word::findAll(['status' => STATUS_ACTIVE]);
        $words = State::sort($words);
        $sounds_str = Sound::makeStringForPlayer($words);
        return $this->render('sounds', compact('sounds_str', 'text'));
    }

    public function actionRepeat($text_id)
    {
        $text = Text::findOne($text_id);
        $words = State::sort($text->words);
        return $this->render('repeat', compact('words', 'text'));
    }

}
