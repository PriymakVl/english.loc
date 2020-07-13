<?php 

namespace app\traits;

use app\modules\word\models\Word;
use yii\helpers\ArrayHelper;

trait WordTrait {


    public function getWords()
    {
        $items = $this->breakWords();
        $words = [];
        if (!$items) return $words;
        foreach ($items as $item) {
            $word = Word::findOne(['engl' => $item, 'status' => STATUS_ACTIVE]);
            if ($word) $words[] = $word;
        }
        return $words;
    }

    protected function breakWords()
    {
        $words = [];
        if (!$this->engl) return $words;
        $items = explode(' ', $this->engl);
        if (!$items) return $words;
        foreach ($items as $item) {
            $word = preg_replace('/[^a-zA-Z]/ui', '', $item); 
            if (!$word) continue;
            $words[] = strtolower($word);
        }
        $words = array_unique($words);
        sort($words);
        return $words;
    }
}