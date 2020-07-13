<?php 

namespace app\models;

use yii\base\Model;

class Statistics extends Model
{
	private $obj;
	private $words = ['all' => 0, 'learned' => 0, 'not_learned' => 0];
	private $phrases = ['all' => 0, 'learned' => 0, 'not_learned' => 0];

	public function __construct($obj)
	{
		$this->obj = $obj;
	}

	public function getWords()
	{
		if (!$this->obj->words) return (object) $this->words;
		$this->words['all'] = count($this->obj->words);
		$this->words['learned'] = $this->calculateLearned($this->obj->words);
		$this->words['not_learned'] = $this->words['all'] - $this->words['learned'];
		return (object) $this->words;
	}

	public function getPhrases()
	{
		return (object) $this->phrases; 
		// if (!$this->obj->phrases) return $this->phrases;
		// $this->phrases['all'] = count($this->obj->phrases);
		// $this->phrases['learned'] = $this->calculateLearned($this->obj->phrases);
		// $this->phrases['not_learned'] = $this->phrases['all'] - $this->phrases['learned'];
		// return (object) $this->phrases;
	}

	private function calculateLearned($items)
    {
    	$sum = 0;
        foreach ($items as $item) {
            if ($item->state->value == STATE_LEARNED) $sum++;       
        }
        return $sum;
    }
}