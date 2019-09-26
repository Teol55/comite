<?php


namespace App\Service;


use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FilesystemInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use League\Flysystem\FileNotFoundException;

class UploaderHelper
{
    const ARTICLE_IMAGE = 'articles';

    /**
     * @var RequestStackContext
     */
    private $requestStackContext;
    /**
     * @var FilesystemInterface
     */
    private $filesystem;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(FilesystemInterface $publicUploadsFilesystem, RequestStackContext $requestStackContext,LoggerInterface $logger)
    {

        $this->requestStackContext = $requestStackContext;
        $this->filesystem = $publicUploadsFilesystem;
        $this->logger = $logger;
    }

    public function uploadArticleImage(File $file,?string $existingFilename):string
    {


        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }
        if ($existingFilename) {
            try {
                $result = $this->filesystem->delete(self::ARTICLE_IMAGE.'/'.$existingFilename);
                if ($result === false) {
                    throw new \Exception(sprintf('Could not delete old uploaded file "%s"', $existingFilename));
                }
            } catch (FileNotFoundException $e) {
                $this->logger->alert(sprintf('Old uploaded file "%s" was missing when trying to delete', $existingFilename));
            }
        }

        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();
        $stream = fopen($file->getPathname(), 'r');
        $result=$this->filesystem->writeStream(
            self::ARTICLE_IMAGE.'/'.$newFilename,
            $stream
        );
        if ($result === false) {
            throw new \Exception(sprintf('Could not write uploaded file "%s"', $newFilename));
        }
        if (is_resource($stream)) {
            fclose($stream);
        }

        return  $newFilename;
    }
    public function getPublicPath(string $path): string
    {
        return $this->requestStackContext
                ->getBasePath().'/uploads/'.$path;
    }
}