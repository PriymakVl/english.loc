<?php

namespace app\modules\phrase\controllers;

use Yii;
use app\modules\phrase\models\{Phrase, PhraseSearch};
use app\modules\text\models\{Text};
use yii\web\{ NotFoundHttpException, UploadedFile };
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class PhraseController extends \app\controllers\BaseController
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

    public function actionIndex()
    {
        $searchModel = new PhraseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBreakText($text_id)
    {
        $text = Text::findOne($text_id);
        Phrase::breakText($text);
        return $this->setMessage("Текст успешно разбит на предложения")->back();
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);
        $text = $model->text;
        $substr = new Phrase();
        return $this->render('view', compact('model', 'substr', 'text'));
    }

    /**
     * Creates a new FullString model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Phrase();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateSub()
    {
        $model = new Phrase();
        $model->load(Yii::$app->request->post());
        if ($model->save()) $this->successMessage();
        else $this->errorMessage();
        return $this->redirect(['view', 'id' => Yii::$app->request->post('Phrase')['parent_id']]);
    }

    /**
     * Updates an existing Phrase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isGet) return $this->render('update', ['model' => $model]);
        $model->load(Yii::$app->request->post());
        $model->sound_file = UploadedFile::getInstance($model, 'sound_file');
        if ($model->save()) {
            $this->setMessage('Фраза отредактирована');
            return $this->redirect(['view', 'id' => $model->id]);
        }

    }

    /**
     * Deletes an existing Sentense model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $str = $this->findModel($id);
        if ($str->remove()) $this->successMessage('Фраза удалена');
        else $this->errorMessage('Ошибка при удалении фразы');
        return $this->redirect(['/text/phrases', 'text_id' => $str->text_id]);
    }

    public function actionDeleteAll($text_id)
    {
        $text = Text::findOne($text_id);
        // foreach ($text->phrases as $phrase) {
        //     $phrase->remove();
        // }
        $res = array_walk($text->phrases, function($phrase) { $phrase->remove(); });

        if ($res) $this->successMessage('Фразы удалены');
        else $this->errorMessage('Ошибка при удалении фраз');

        $this->redirect(['/text/phrases', 'text_id' => $text_id]);
    }


    /**
     * Finds the Sentense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sentense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Phrase::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
