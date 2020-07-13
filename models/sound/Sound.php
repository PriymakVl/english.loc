<?php

namespace app\models\sound;

use Yii;
use yii\web\NotFoundHttpException;
use app\modules\string\models\{FullString, SubString};
use app\modules\word\models\{Word};

class Sound extends \app\models\ModelApp
{
    //for sounds in js file
    public static function makeStringForPlayer($objects)
    {
        $sounds_str = '';
        foreach ($objects as $obj) {
            // if (!$obj->sound_id && $sound_flag) continue;
            $sounds_str .= $obj->sound->en.':'.$obj->sound->ru.':'.$obj->engl.':'.$obj->ru.':'.$obj->id.';';
        }
        return $sounds_str;
    }

    public static function makePlayer($obj, $lang)
    {
        if (!$obj->sound->$lang) return '<span class="red">нет</span>';
        return sprintf('<i class="fas fa-play-circle player-btn" onclick="sound_play(this);" sound="%s"></i>', $obj->sound->$lang);
    }

    public static function getFromTemp()
    {
        $files = scandir('temp');
        for ($i = 2; $i < count($files); $i++) {
            $list[] = new \SplFileInfo($files[$i]);
        } 
        return $list;  
    }

    public static function generateFilename($ext)
    {
        do {
            $name = uniqid();
            $filename = $name . '.' . $ext;
            $file = '/web/sounds/' . $filename;
        } while (file_exists($file));
        return $filename;
    }

}
