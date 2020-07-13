<?php 

namespace app\traits;

use app\modules\phrase\models\Phrase;

trait PhraseTrait {

    public static function sort($phrases, $rules = false) 
    {
        $rules = $rules ? $rules : ['sub_first'];
        foreach ($rules as $rule) {
            if ($rule = 'sub_first') $phrases = self::sortSubFirst($phrases);
        }
        return $phrases;
    }

    public static function sortSubFirst($phrases)
    {
        $sub = [];
        $core = [];
        foreach ($phrases as $phrase) {
            if ($phrase->parent_id != PARENT_ID_CORE) $sub[] = $phrase;
            else $core[] = $phrase;
        }
        return array_merge($sub, $core);
    }

    public static function sortChildrenFirst($phrases)
    {
        $result = [];
        foreach ($phrases as $phrase) {
            if ($phrase->parent_id != PARENT_ID_CORE) continue;
            if ($phrase->substr) $result = self::addSubStringBeforeParent($phrase, $result);
            else $result[] = $phrase;
        }
        return $result;
    }

    private static function addSubStringBeforeParent($parent, $result) 
    {
        foreach ($parent->substr as $item) {
            $result[] = $item;
        }
        $result[] = $parent;
        return $result;
    }
}