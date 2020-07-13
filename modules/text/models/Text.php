<?php

namespace app\modules\text\models;

use Yii;
use app\modules\word\models\{Word};
use app\modules\phrase\models\{Phrase};
use app\modules\category\models\Category;
use yii\helpers\ArrayHelper;
use app\models\Statistics;

/**
 * This is the model class for table "text".
 *
 * @property int $id
 * @property string|null $engl
 * @property string|null $ru
 * @property string|null $created
 * @property int|null $status
 */
class Text extends \app\models\ModelApp
{
    use \app\traits\WordTrait;

    public $statistics;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'texts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'cat_id'], 'required'],
            [['engl', 'ru', 'title', 'ref'], 'string'],
            [['created'], 'safe'],
            [['status', 'cat_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'Заголовок',
            'engl' => 'Английский',
            'ru' => 'Русский',
            'created' => 'Добавлен',
            'status' => 'Status',
            'cat_id' => 'Категория',
        ];
    }


    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }

    public function getPhrases()
    {
        return $this->hasMany(Phrase::className(), ['text_id' => 'id'])->where(['status' => STATUS_ACTIVE]);
    }

    public function getStat()
    {
        return new Statistics($this);
    }
}
