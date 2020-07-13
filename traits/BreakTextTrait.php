<?php 

namespace app\traits;

use app\modules\phrase\models\Phrase;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

trait BreakTextTrait {

    public static function breakText($text)
    {
        $engl_arr = explode(PHP_EOL, $text->engl);
        $ru_arr = explode(PHP_EOL, $text->ru);
        self::addList($engl_arr, $ru_arr, $text->id);
    } 

    private static function addList($engl_arr, $ru_arr, $text_id)
    {
        if (!$engl_arr) throw new NotFoundHttpException('Не массива строк трайт BreakTextTrait.php');
        for ($i = 0, $count = count($engl_arr); $i < $count; $i++) {
            $check = Phrase::findOne(['engl' => $engl_arr[$i], 'text_id' => $text_id]);
            if ($check) continue;
            self::add($engl_arr[$i], $ru_arr[$i], $text_id);
        }
    }


    public static function add($engl, $ru, $text_id)
    {
        $phrase = new Phrase;
        $engl = self::prepare($engl);
        $ru = self::prepare($ru);
        $phrase->engl = $engl;
        $phrase->ru = $ru;
        $phrase->text_id = $text_id;
        $phrase->save(false);
    }

    public static function prepare($str)
    {
        $str = str_replace("\r\n", "", $str);
        $str = trim($str);
        $str = chop($str, '.');
        $str = chop($str, ',');
        $str = chop($str, '?');
        return $str;
    }


}