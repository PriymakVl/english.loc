<?php 

namespace app\traits;

use app\models\Sound;

trait SoundTrait {

	public function getSound()
    {
        return $this->hasOne(Sound::className(), ['id' => 'sound_id']);
    }

    //for sounds in js file
    public static function makeStringForPlayer($objects)
    {
        $sounds_str = '';
        foreach ($objects as $obj) {
            if (!$obj->sound_id) continue;
            $sounds_str .= $obj->sound->filename.':'.$obj->engl.':'.$obj->ru.':'.$obj->id.';';
        }
        return $sounds_str;
    }

    public function makePlayer()
    {
        if (!$this->sound) return '<span class="red">нет</span>';
        return sprintf('<i class="fas fa-play-circle player-btn" onclick="sound_play(this);" sound="%s"></i>', $this->sound->filename);
    }
}