<?php

namespace backend\components;

use Faker\Provider\File;
use yii\base\Component;
use yii\base\Exception;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\base\InvalidArgumentException;

/**
 * Class Storage
 * @package frontend\components
 */
class Storage extends Component implements IStorage
{
    private $fileName;
    private $storagePath;
    private $currentFile;
    private $savedDirById;

    public function __construct(string $storagePath, $currentFile = false, $savedDirById = false, array $config = [])
    {
        $this->storagePath = $this->setStoragePath($storagePath, $savedDirById);
        $this->currentFile = $currentFile;
        $this->savedDirById = $savedDirById;
        parent::__construct($config);
    }

    /**
     * @param UploadedFile $file
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function saveUploadedFile(UploadedFile $file)
    {
        $path = $this->preparePath($file);

        if ($this->currentFile !== false && strlen($this->currentFile) > 10) $this->removeCurrentFile();

        if ($path && $file->saveAs($path)) {
            return $this->fileName;
        }

        throw new Exception('File already exist');
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \yii\base\Exception
     */
    protected function preparePath(UploadedFile $file)
    {
        $this->fileName = $this->getFileName($file);

        $path = $this->getStorageNormalizePath() . "/{$this->fileName}";

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
        $hash = sha1_file($file->tempName); // 0ca9277f91e40054767f69afeb0426711ca0fddd

        $name = ($this->savedDirById === false) ? $this->splitFilename($hash) : $hash;

        return $name . '.' . $file->extension;
    }

    /**
     * @param $filename
     * @return mixed
     */
    private function splitFilename($filename)
    {
        $filename = substr_replace($filename, '/', 3, 0);
        return substr_replace($filename, '/', 7, 0);  // 0c/a9/277f91e40054767f69afeb0426711ca0fddd
    }

    /**
     * @return bool|string
     */
    public function getStoragePath()
    {
        return $this->storagePath;
    }

    /**
     * @param $storagePath
     * @param $savedDirById
     * @return string
     */
    private function setStoragePath($storagePath, $savedDirById)
    {
        return ($savedDirById !== false) ? $storagePath . "/$savedDirById" : $storagePath;
    }

    /**
     * @throws Exception
     */
    private function removeCurrentFile()
    {
        if ($this->savedDirById !== false)
            $this->removeFile($this->currentFile);
        else
            $this->removeDirWithCurrentFIle();
    }

    /**
     * @return bool|string normalize path
     */
    public function getStorageNormalizePath()
    {
        return FileHelper::normalizePath($this->storagePath);
    }

    /**
     * @throws Exception
     */
    private function removeDirWithCurrentFIle()
    {
        try {
            $dir = explode('/', $this->currentFile);
            $dirForRemove = $this->removeDirectory($this->getStoragePath() . $dir[0]);

            if (is_dir($dirForRemove)) $this->removeDirectory($dirForRemove);

        } catch (\Exception $e) {
            throw new Exception('Remove file failed');
        }
    }

    /**
     * @param string $directory
     * @return bool
     * @throws \yii\base\Exception
     */
    public function foundFile(string $directory)
    {
        FileHelper::createDirectory($directory);

        $result = FileHelper::findFiles($directory);

        if (empty($result)) {
            return false;
        }

        $result = array_map(function ($path) {
            return basename($path);
        }, $result);

        return $result[0];
    }

    /**
     * @param string $filename
     * @return string
     */
    protected function getFullPathFile(string $filename)
    {
        return $this->getStorageNormalizePath() . "/{$filename}";
    }

    /**
     * @param $filename
     * @return bool
     */
    public function removeFile($filename)
    {
        if ($file = $this->getFullPathFile($filename)) {
            FileHelper::unlink($file);
            return true;
        }

        return false;
    }

    /**
     * @param $path
     * @throws \yii\base\ErrorException
     */
    public function removeDirectory($path)
    {
        FileHelper::removeDirectory($path);
    }

    public static function getFilesOnDirectory($storage, $id) :array
    {
        $dir = FileHelper::normalizePath("$storage/$id");

        try {
            return FileHelper::findFiles($dir, ['recursive' => false]);
        } catch (InvalidArgumentException $e) {
            return [];
        }
    }

}