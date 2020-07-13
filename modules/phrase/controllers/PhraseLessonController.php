<?php

namespace app\modules\phrase\controllers;

use Yii;
use app\modules\phrase\models\{Phrase};
use app\modules\text\models\{Text};
use app\models\sound\Sound;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\Url;

/**
 * PhraseController implements the CRUD actions for Phrase model.
 */
class PhraseLessonController extends \app\controllers\BaseController
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionSounds($text_id)
    {
        $text = Text::findOne($text_id);
        $phrases = Phrase::sortChildrenFirst($text->phrases);
        $sounds_str = Sound::makeStringForPlayer($phrases);
        return $this->render('sounds', compact('sounds_str', 'text'));
    }

    public function actionRepeat($text_id)
    {
        $text = Text::findOne($text_id);
        $phrases = $text->phrases;
        shuffle($phrases);
        return $this->render('repeat', compact('phrases', 'text'));
    }

    public function actionStudy($text_id, $phrase_id = false)
    {
        Url::remember();
        $text = Text::findOne($text_id);
        $phrases = $text->phrases;
        $phrase = $phrase_id ? Phrase::findOne($phrase_id) : $text->phrases[0];
        return $this->render('study', compact('text', 'phrase', 'phrases'));
    }

    /**
     * Finds the Phrase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Phrase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubString::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
