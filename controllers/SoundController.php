<?php

namespace app\controllers;

use Yii;
use app\models\sound\{SoundWord, SoundPhrase};
use app\modules\phrase\models\Phrase;
use app\modules\word\models\Word;

class SoundController extends \app\controllers\BaseController
{
    public function actionCreateFileStrings($lang, $text_id = false, $all = false)
    {
        if ($text_id)  $items = Phrase::findAll(['text_id' => $text_id, 'status' => STATUS_ACTIVE]);
        else $items = Word::findAll(['status' => STATUS_ACTIVE]);
        if (!$items) return $this->setMessage('Нет элементов', 'error')->back();
        $this->giveFileToDownload($items, $lang, $all);
    }

<<<<<<< HEAD
    private function giveFileToDownload($items, $lang, $all) 
=======
    private function giveFileToDownload($items, $lang) 
>>>>>>> 7064f0b72bcdaee9d50498f2b471010b67a15af2
    {
        $this->setHeader();
        foreach ($items as $item) {
            if ($lang == 'en') {
                if ($item->engl == 'con') continue; //не озвучивает программа
<<<<<<< HEAD
                if ($item->sound->en) continue;
=======
                if ($item->sound->en ) continue;
>>>>>>> 7064f0b72bcdaee9d50498f2b471010b67a15af2
                echo trim($item->engl), "\r\n", "\r\n", "\r\n";
            }
            else {
                if ($item->sound->ru) continue;
                echo trim($item->ru), "\r\n", "\r\n", "\r\n";
            }
        }
		exit();
    }

    private function setHeader()
    {
        header('HTTP/1.1 200 OK');
        header("Content-Description: file transfer");
        header("Content-transfer-encoding: binary");
        header('Content-Disposition: attachment; filename="for_sounds.txt"');
    }

    public function actionAddForWords($lang)
    {
        $res = SoundWord::addList($lang);
        if ($res) $this->setMessage('Звуковые файлы добавлены');
        else $this->errorMessage('Ошибка при добавлении файлов');
        $this->redirect(['word/word/index']);
    }

    public function actionAddForPhrases($lang, $text_id)
    {
        $res = SoundPhrase::addList($lang, $text_id);
        if ($res) $this->setMessage('Звуковые файлы добавлены');
        else $this->errorMessage('Ошибка при добавлении файлов');
        $this->back();
    }


    

}
