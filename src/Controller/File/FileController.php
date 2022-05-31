<?php

namespace App\Controller\File;


use App\Entity\File\File;
use App\Service\File\FileUploader;
use App\Service\FileResize;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class FileController extends AbstractController{

    public $path;
    public $resize;
    public $params;

    public function __invoke(Request $request, FileUploader $fileUploader): File
    {
        $uploadedFile = $request -> files -> get('file');
        if(!$uploadedFile){
            throw new BadRequestHttpException('File is required');
        }
        $FileObject = new file();
        [$fullPath, $simplePath] = $fileUploader->upload($uploadedFile);
        $FileObject-> name = $request->get('name');
        $FileObject ->dateCreate = new \DateTime();
        $FileObject ->dateUpdate = new \DateTime();
        $FileObject -> filePath = $simplePath;

        $resize = new FileResize($uploadedFile, $fullPath, 100, 200);
        $params = $resize->resize();
        $resize->resizeImage($params);



        return $FileObject;
    }

}
