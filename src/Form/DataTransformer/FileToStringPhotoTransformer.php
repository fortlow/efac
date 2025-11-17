<?php
declare(strict_types=1);

namespace App\Form\DataTransformer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\HttpFoundation\File\File;

class FileToStringPhotoTransformer implements DataTransformerInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param mixed $value
     * @return File|null
     */
    public function transform(mixed $value): ?File
    {
        try {
            if (null === $value) {
                return null;
            }

            if (strlen($value) == 0) {
                return null;
            }

            if(file_exists($_ENV['DIR_PHOTO'].'/'.$value)) return new File($_ENV['DIR_PHOTO'].'/'.$value);

            return null;

        } catch (TransformationFailedException $e) {
            return null;
        }
    }

    /**
     * @param mixed $value
     * @return File|null
     */
    public function reverseTransform(mixed $value): ?File
    {
        try {
            if (is_null($value)) {
                return null;
            } else {
                return $value;
            }
        } catch (TransformationFailedException $e) {
            return null;
        }
    }
}