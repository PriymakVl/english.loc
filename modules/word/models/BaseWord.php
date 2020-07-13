<?php

namespace app\modules\word\models;

use Yii;
use app\models\Sound;
use app\modules\word\models\Word;
use app\modules\string\models\{FullString, Substring};

class BaseWord extends \app\models\ModelApp
{

    public static function tableName()
    {
        return 'words';
    }

    public  static function add($en, $ru) 
    {
        $word = new self;
        $word->engl = self::prepare($en); 
        $word->ru = self::prepare($ru, true);
        $word->status = STATUS_ACTIVE;
        if (!$word->save(false)) throw new NotFoundHttpException('error add class Word.');
        return $word;
    }

    public static function prepare($word, $flag_ru = false)
    {
        $word = strtolower(trim($word));
        if ($flag_ru) $word = mb_convert_encoding($word, "utf-8", "windows-1251");
        return htmlspecialchars($word);
    }

}
