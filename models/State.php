<?php

namespace app\models;


class State {

	public static function sort($items, $state = STATE_NOT_LEANED)
    {
    	$sort = [];
        if (!$items) return $sort;
        $sort = array_filter($items, function($item) {return $item->state->value == $state;});
        if ($sort) return array_values($sort);
    }


}