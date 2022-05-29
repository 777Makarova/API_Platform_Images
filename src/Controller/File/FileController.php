<?php

namespace App\Controller\File;


use App\Entity\File\File;
use App\Service\File\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class FileController extends AbstractController{

    public function __invoke(Request $request, FileUploader $fileUploader): File
    {
        $uploadedFile = $request -> files -> get('file');
        if(!$uploadedFile){
            throw new BadRequestHttpException('File is required');
        }
        $FileObject = new file();
        $FileObject-> name = $request->get('name');
        $FileObject -> filePath = $fileUploader -> upload ($uploadedFile);



        return $FileObject;
    }

}
