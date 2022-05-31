<?php

namespace App\Service;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use PhpParser\Builder\Function_;

class FileResize
{
    private $FilePath;
    private $imagine;
    public $MAX_WIDTH;
    public $MAX_HEIGHT;

    public function __construct($uploadPath, string $FilePath, int $width, int $height)
    {
        $this->FilePath = $FilePath;
        $this->imagine = new Imagine();
        $this->MAX_WIDTH = $width;
        $this->MAX_HEIGHT = $height;
    }

    public function resize(): array
    {
        list($iwidth, $iheight) = getimagesize($this->FilePath);
        $ratio = $iwidth / $iheight;
        $width = $this->MAX_WIDTH;
        $height = $this->MAX_HEIGHT;
        if ($width / $height > $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }

        $parametrs = [$width, $height];

        return $parametrs;

    }

    public function resizeImage($parametrs): bool
    {
        $image = $this->imagine->open($this->FilePath);
        [$width, $height] = $parametrs;
        $image->resize(new Box($width, $height))->save('/home/tatyana/Image_API/public/uploads/image.jpg');

        return true;
    }
}