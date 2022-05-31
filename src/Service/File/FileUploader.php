<?php

namespace App\Service\File;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile; // Класс загруженного файла предоставляет методы для получения
// исходного расширения файла (getClientOriginalExtension()), исходного размера файла (getSize()) и исходного имени файла (getClientOriginalName()).
use Symfony\Component\HttpFoundation\UrlHelper; // класс (служба), который предоставляет 2 метода:
// getAbsoluteUrl(), getRelativePath(), которые генерируют абс и отн URL-фдреса для заданного пути
use Symfony\Component\String\Slugger\SluggerInterface; // Слаггер преобразует полученную строку в сторку,
// содержающую безопасные символы ASCII (а не Unicode) - более безопасно
use Imagine\Gd\Imagine;
use Imagine\Image\Box;


class FileUploader{
    private $uploadPath;
    private SluggerInterface $slugger;
    private UrlHelper $urlHelper;
    private string $relativeUploadsDir;
    private Imagine $imagine;
    private const MAX_WIDTH = 200;
    private const MAX_HEIGHT = 150;


    public function __construct($publicPath, $uploadPath, SluggerInterface $slugger, UrlHelper $urlHelper)
    {
        $this -> uploadPath = $uploadPath;
        $this -> slugger = $slugger;
        $this -> urlHelper = $urlHelper;
        $this->imagine = new Imagine();

//        получаем загруженный файл относительно public Path
        $this ->relativeUploadsDir = str_replace($publicPath, '', $this->uploadPath). '/';
    }

    public function upload (UploadedFile $file): array
    {
        // получаем оригинальное имя файла
        $originalFilename = pathinfo($file -> getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this ->slugger->slug($originalFilename);
        $fileName = $safeFilename. '-'.uniqid(). '.'. $file ->guessExtension();

        try {
            $file->move($this->getuploadPath(), $fileName);
        } catch (FileException $e) {

        }
        $paths = [$this->getuploadPath().'/'.$fileName, $fileName];

        return $paths;

    }

    /**
     * @return mixed
     */
    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    public function getUrl(?string $fileName, bool $absolute = true): ?string
    {
     if(empty($fileName)) return null;

     if($absolute){
         return $this->urlHelper->getAbsoluteUrl($this->relativeUploadsDir->$fileName);
     }
     return $this->urlHelper->getRelativePath($this->relativeUploadsDir->$fileName);

    }


}