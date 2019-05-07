<?php


namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;


class Storage extends Component implements StorageInterface
{
    private $fileName;

    /**
     *  Save uploadedFile to disk
     * @param UploadedFile $file
     * @return mixed
     */
    public function saveUploadedFile(UploadedFile $file)
    {
        $path = $this->preparePath($file);

        if ($path && $file->saveAs($path)) {
            return $this->fileName;
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \yii\base\Exception
     */
    protected function preparePath(UploadedFile $file)
    {
        $this->fileName = $this->getFilename($file);

        $path = $this->getStoragePath() . $this->fileName;

        $path = FileHelper::normalizePath($path);
        if (FileHelper::createDirectory(dirname($path))) {
            return $path;
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function getFilename(UploadedFile $file)
    {
        // $file->tempname   -   /tmp/qio93kf

        $hash = sha1_file($file->tempName); // 0ca9277f91e40054767f69afeb0426711ca0fddd

        $name = substr_replace($hash, '/', 2, 0);
        $name = substr_replace($name, '/', 5, 0);  // 0c/a9/277f91e40054767f69afeb0426711ca0fddd
        return $name . '.' . $file->extension;  // 0c/a9/277f91e40054767f69afeb0426711ca0fddd.jpg
    }

    protected function getStoragePath()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']);
    }

    /**
     *
     * @param string $filename
     * @return string
     */
    public function getFile($filename)
    {
        return Yii::$app->params['storageUri'].$filename;
    }
}