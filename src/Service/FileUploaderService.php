<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderService
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function upload(UploadedFile $file, $folder)
    {
        $fileName = md5(uniqid('', true)).'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory() . '/uploads/' . $folder, $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
        return $fileName;
    }

    public function removeFile($fileName)
    {
        $file_path = $this->getTargetDirectory().'/uploads/image/'.$fileName;
        if(file_exists($file_path)) unlink($file_path);
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
