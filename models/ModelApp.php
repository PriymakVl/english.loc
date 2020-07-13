<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use app\models\{ State};
use app\models\sound\Sound;
use yii\web\NotFoundHttpException;
use app\modules\string\models\{Phrase};
use app\modules\word\models\{Word};
use app\modules\text\models\{Text};

class ModelApp extends \yii\db\ActiveRecord
{

    public function remove()
    {
        $this->status = STATUS_INACTIVE;
        if (!$this->save(false)) throw new NotFoundHttpException('error remove item class app\modelsModelApp');
        return $this;
    }


    public function getClassName()
    {
        $path = get_called_class();
        $pos_end_delimeter = strrpos($path, '\\');
        return substr($path, $pos_end_delimeter + 1);
    }

     public function next($items)
    {
        $ids = ArrayHelper::getColumn($items, 'id');
        $index = array_search($this->id, $ids);
        if ($index == array_key_last($ids)) return $items[0];
        foreach ($items as $item) {
            if ($item->id == $ids[$index + 1]) return $item;
        }
    }

    public function prev($items)
    {
        $ids = ArrayHelper::getColumn($items, 'id');
        $index = array_search($this->id, $ids);
        if ($index == 0) return $items[array_key_last($ids)];
        foreach ($items as $item) {
            if ($item->id == $ids[$index - 1]) return $item;
        }
    }

    public function passed($items) {
        $ids = ArrayHelper::getColumn($items, 'id');
        return array_search($this->id, $ids);
    }

    public function rest($items)
    {
        $passed = $this->passed($items);
        return count($items) - $passed;
    }

    public function player($lang)
    {
        return Sound::makePlayer($this, $lang);
    }

    

}
