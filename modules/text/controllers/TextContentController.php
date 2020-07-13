<?php

namespace app\modules\text\controllers;

use Yii;
use yii\helpers\Url;
use app\modules\text\models\{Text, TextSearch};
use app\modules\phrase\models\{Phrase, PhraseSearch};
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class TextContentController extends \app\controllers\BaseController
{


    public function actionWords($text_id)
    {
        Url::remember();
        $text = Text::findOne($text_id);
        return $this->render('words', compact('text'));
    }

    public function actionPhrases($text_id)
    {
        $text = Text::findOne($text_id);
        $searchModel = new PhraseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('phrases', compact('searchModel', 'dataProvider', 'text'));
    }

    
    /**
     * Finds the Text model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubText the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Text::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
