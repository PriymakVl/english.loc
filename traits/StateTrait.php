<?php 

namespace app\traits;

use Yii;
use app\modules\word\models\WordState;
use app\modules\phrase\models\PhraseState;

trait StateTrait 
{
    public function getValueStr()
    {
        if ($this->value == STATE_LEARNED) return 'Выучено';
        return 'Не выучено';
    }

    public function setState()
    {
        $state = $this->getState();
        $state->value = ($state->value == STATE_NOT_LEARNED) ? STATE_LEARNED : STATE_NOT_LEARNED;
        return $state->save(false);
    }

    public function getState()
    {
        $class = $this->getClassName();
        if ($class = 'Word') return $this->getStateWord();
        if ($class = 'Phrase') return $this->getStatePhrase();
    }

    private function getStateWord()
    {
        $state = WordState::findOne(['user_id' => Yii::$app->user->id, 'word_id' => $this->id]);
        if ($state) return $state;
        return WordState::add($this->id);
    }

    private function getStatePhrase()
    {
        $state = PhraseState::findOne(['user_id' => Yii::$app->user->id, 'phrase_id' => $this->id]);
        if ($state) return $state; 
        return PhraseState::add($this->id);
    }

}