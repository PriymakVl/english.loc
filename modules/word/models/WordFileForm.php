<?php

namespace app\modules\word\models;

use Yii;
use app\modules\word\models\Word;

class WordFileForm extends \yii\base\Model
{
    public $file_ru;
    public $file_en;
    public $countAdd = 0;

    public function rules()
    {
        return [
            [['file_ru', 'file_en'], 'required'],
            [['file_ru', 'file_en'], 'file', 'extensions' => 'txt'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file_ru' => 'Файл с русскими словам',
            'file_en' => 'Файл с английскими словами',
        ];
    }

    public function add()
    {
        $words = $this->getWords();
        $this->saveList($words);
        return true;
    }

    private function getWords()
    {
        $words['ru'] = file($this->file_ru->tempName);
        $words['en'] = file($this->file_en->tempName);
        return $words;
    }

    public function saveList($words)
    {
        for ($i = 0, $count = count($words['en']); $i < $count; $i++) {
            $word = Word::getByName($words['en'][$i]);
            if (!$word) {
                Word::add($words['en'][$i], $words['ru'][$i]);
                $this->countAdd++;
            }
        }
    }

}
