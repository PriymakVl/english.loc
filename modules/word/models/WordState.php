<?php

namespace app\modules\word\models;

use Yii;

/**
 * This is the model class for table "words_states".
 *
 * @property int $id
 * @property int|null $word_id
 * @property int|null $user_id
 * @property int|null $value
 */
class WordState extends \app\models\ModelApp
{
    use \app\traits\StateTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'words_states';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['word_id', 'user_id', 'value'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word_id' => 'Word ID',
            'user_id' => 'User ID',
            'value' => 'Value',
        ];
    }

    public static function add($word_id)
    {
        $state = new self;
        $state->word_id = $word_id;
        $state->user_id = Yii::$app->user->id;
        if($state->save(false)) return $state;
        throw new NotFoundHttpException('Ошибка при сохранения состояния слова');
    }
}
