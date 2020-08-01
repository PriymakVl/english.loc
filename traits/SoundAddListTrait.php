<?php 

namespace app\traits;

use app\models\Sound;
use app\modules\word\models\Word;
use app\modules\phrase\models\Phrase;

trait SoundAddListTrait {

    public static function addList($type)
    {
        $files = scandir('temp');
        for ($i = 2; $i < count($files); $i++) {
            $file = new \SplFileInfo($files[$i]);
            self::add($file, $type);
        }   
    }

    public static function add($file, $type)
    {
        $item = self::geItemByEngl($type, $file);
        if (!$item) return;

        $filename = self::generateFileName($file->getExtension());
        $item->sound_id = self::create($filename)->id;

        rename('temp/' . $file->getBasename(), 'sounds/' . $filename);

        return $item->save(false);
    }

    private static function geItemByEngl($type, $file)
    {

        $engl = $file->getBasename('.' . $file->getExtension());
        if ($type == TYPE_WORD) return Word::findOne(['engl' => $engl, 'status' => STATUS_ACTIVE]);
        if ($type == TYPE_PHRASE) return Phrase::findOne(['engl' => $engl, 'status' => STATUS_ACTIVE]);
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