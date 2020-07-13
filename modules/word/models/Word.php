<?php

namespace app\modules\word\models;

use Yii;
use yii\helpers\Html;
use app\models\sound\SoundWord;
use app\modules\phrase\models\Phrase;
use app\modules\word\models\WordState;

/**
 * This is the model class for table "word".
 *
 * @property int $id
 * @property string $engl
 * @property string $ru
 * @property int|null $status
 */
class Word extends \app\modules\word\models\BaseWord
{
    use \app\traits\WordTrait, \app\traits\StateTrait;

    // const SCENARIO_STATE = 'state';
    // const SCENARIO_DELETE = 'delete';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['engl', 'ru'], 'required'],
            [['status'], 'integer'],
            [['engl', 'ru'], 'string', 'max' => 255],
            [['engl'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'engl' => 'Engl',
            'ru' => 'Ru',
            'status' => 'Status',
            'saund_en' => 'Saund En',
            'saund_ru' => 'Saund Ru'
        ];
    }

    public function getPhrases()
    {
        $query = "SELECT * FROM " . Phrase::tableName() . " WHERE engl LIKE :engl AND status = ". STATUS_ACTIVE;
        $engl = '% ' . $this->engl . ' %';
        $phrases = Phrase::findBySql($query, [':engl' => $engl])->all();
        return Phrase::sort($phrases);
    }

    public static function getByName($lang, $name)
    {
        if($lang == 'en') {
            $en = self::prepare($name);
            return self::findOne(['engl' => $en, 'status' => STATUS_ACTIVE]);
        }
        else {
            // $ru = self::prepare($name, true);
            return self::findOne(['ru' => $name, 'status' => STATUS_ACTIVE]);
        }
    }

    public function getSound()
    {
        return $this->hasOne(SoundWord::className(), ['id' => 'sound_id']);
    }
}
