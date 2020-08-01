<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class SoundUpload extends Model{
    
    public $file;
    public $folder;


    public function uploadFile(UploadedFile $file, $currentFile)
    {
        $this->file = $file;
        $this->setFolder();
        $this->deleteCurrentFile($currentFile);
        return $this->saveFile();
    }

    public function setFolder()
    {
        $this->folder = Yii::getAlias('@webroot') . '/sounds/';
    }

    public function generateFilename()
    {
        do {
            $name = uniqid();
            $filename = $name . '.' . $this->file->extension;
            $file = '/web/sounds/' . $filename;
        } while (file_exists($file));
        return $filename;
    }

    public function deleteCurrentFile($currentFile)
    {
        if ($this->fileExists($currentFile)) unlink($this->folder . '' . $currentFile);
    }

    public function fileExists($currentFile)
    {
        if (empty($currentImage)) return false;
        return file_exists($this->folder . '/' . $currentFile);
    }

    public function saveFile()
    {
        $filename = $this->generateFilename();
        $this->file->saveAs($this->folder . $filename);
        return $filename;
    }
}