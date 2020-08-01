<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;
use app\modules\string\models\{FullString, SubString};
use app\modules\word\models\{Word};

/**
 * This is the model class for table "sound".
 *
 * @property int $id
 * @property int $type
 * @property int $item_id
 * @property string $filename
 * @property int|null $status
 */
class Sound extends \app\models\ModelApp
{
    use \app\traits\SoundTrait, \app\traits\SoundAddListTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sounds';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type', 'item_id', 'status'], 'integer'],
            [['filename'], 'string', 'max' => 100],
            [['filename'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'item_id' => 'Item ID',
            'filename' => 'Filename',
            'status' => 'Status',
        ];
    }

    // public function scenarios()
    // {
    //     $scenarios = parent::scenarios();

    //     // $scenarios[static::SCENARIO_FILE] = ['type'];
    //     $scenarios[static::SCENARIO_CREATE] = ['type', 'filename', 'item_id'];
    //     return $scenarios;
    // }

    public static function create($filename)
    {
        $sound = new self;
        $sound->filename = $filename;
        $sound->save(false);
        return $sound;
    }

}
