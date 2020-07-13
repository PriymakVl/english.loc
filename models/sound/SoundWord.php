<?php

namespace app\models\sound;

use Yii;
use app\modules\word\models\Word;

/**
 * This is the model class for table "sounds_words".
 *
 * @property int $id
 * @property string $ru
 * @property string $en
 * @property int|null $status
 */
class SoundWord extends \app\models\sound\Sound
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sounds_words';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['ru', 'en'], 'string', 'max' => 100],
            [['ru'], 'unique'],
            [['en'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ru' => 'Ru',
            'en' => 'En',
            'status' => 'Status',
        ];
    }

    public static function addList($lang)
    {
        $list = self::getFromTemp();
        if (!$list) return false;

        foreach ($list as $file) {
            $word = Word::getByName($lang, $file->getBasename('.' . $file->getExtension()));
            if (!$word) continue;
            $res = self::addFromTemp($word, $file, $lang);
        } 
        return true;
    }

    public static function addFromTemp($obj, $file, $lang)
    {
        $filename = self::generateFileName($file->getExtension()); 
        $obj->sound_id = self::add($obj->sound_id, $filename, $lang)->id;
        rename('temp/' . $file->getBasename(), 'sounds/' . $filename);
        return $obj->save(false);
    }

    public static function add($id, $filename, $lang)
    {
        $sound = $id ? self::findOne($id) : new self;
        if ($lang == 'en') $sound->en = $filename;
        else $sound->ru = $filename;
        $sound->save(false);
        return $sound;
    }
}
