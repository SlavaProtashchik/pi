<?php
namespace AppBundle\Service;

use AppBundle\Repository\ImageRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Exception;

class ImageService
{
    const SERVICE = 'app.service.image';
    const MEDIA_PATH = __DIR__ . '/../../../web/media/';

    private $imageRepo;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepo = $imageRepository;
    }

    public function upload(UploadedFile $file)
    {
        try {
            $file->move(self::MEDIA_PATH, $file->getClientOriginalName());
        } catch (Exception $e) {
            return false;
        }

        return $file->getClientOriginalName();
    }
}
