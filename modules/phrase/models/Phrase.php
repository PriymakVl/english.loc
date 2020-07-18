<?php

namespace app\modules\phrase\models;

use Yii;
use yii\web\NotFoundHttpException;
use app\models\sound\{SoundPhrase, SoundUpload};
use app\modules\text\models\Text;

/**
 * This is the model class for table "strings".
 *
 * @property int $id
 * @property string|null $engl
 * @property string|null $ru
 * @property int|null $id_text
 * @property int|null $status
 */
class Phrase extends \app\models\ModelApp
{
    use \app\traits\PhraseTrait, \app\traits\BreakTextTrait;
    
    public $sound_file;
    public $sound_lang;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phrases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['engl', 'ru'], 'required'],
            [['text_id', 'status', 'sound_id'], 'integer'],
            [['engl', 'ru'], 'string', 'max' => 255],
            [['engl', 'ru'], 'trim'],
            [['sound_file'], 'file',  'extensions' => 'wav, mp3'],
            ['sound_lang', 'string'],
            ['parent_id', 'integer'],
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
            'text_id' => 'Id Text',
            'status' => 'Status',
            'prev' => 'Предыдущая фраза',
            'next' => 'Следующая фраза',
        ];
    }

    public function beforeSave($insert) 
    {
        if ($this->sound_file) {
            $file = new SoundUpload();
            $sound = $this->sound_id ? SoundPhrase::findOne($this->sound_id) : new SoundPhrase();
            $old_filename = $this->sound_lang == 'en' ? $sound->en : $sound->ru;
            $filename = $file->uploadFile($this->sound_file, $old_filename); 
            if ($this->sound_lang == 'en') $sound->en = $filename;
            else if ($this->sound_lang == 'ru') $sound->ru = $filename;
            $sound->save(false);
            $this->sound_id = $sound->id;
        }
        return parent::beforeSave($insert);
    }

    public function getText()
    {
        return $this->hasOne(Text::className(), ['id' => 'text_id']);
    }

    public function getSubstr()
    {
        return self::findAll(['parent_id' => $this->id, 'status' => STATUS_ACTIVE]);
    }

    public function templateSubstr()
    {
        if (!$this->substr) return '';
        $template = '<ul>';
        foreach ($this->substr as $sub) {
            $template .= sprintf('<li title="%s">%s</li>', $sub->ru, $sub->engl);
        }
        return $template . '</ul>';
    }

    public function getSound()
    {
        return $this->hasOne(SoundPhrase::className(), ['id' => 'sound_id']);
    }

    public static function getByName($lang, $text_id, $name)
    {
        if($lang == 'en') return self::findOne(['engl' => $name, 'text_id' => $text_id, 'status' => STATUS_ACTIVE]);
        else return self::findOne(['ru' => $name, 'text_id' => $text_id, 'status' => STATUS_ACTIVE]);
    }

    

    



}
