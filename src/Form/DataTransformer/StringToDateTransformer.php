<?php
declare(strict_types=1);

namespace App\Form\DataTransformer;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class StringToDateTransformer implements DataTransformerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @param mixed $value
     * @return mixed|null
     */
    public function transform(mixed $value): mixed
    {
        try {
            if (null === $value) {
                return null;
            }

            if (!is_object($value)) {
                return null;
            }

            return $value;
        } catch (TransformationFailedException $e) {
            return null;
        }
    }

    /**
     * @param mixed $value
     * @return \DateTime|null
     */
    public function reverseTransform(mixed $value): ?\DateTime
    {
        try {
            if (is_null($value)) {
                return null;
            }

            return $value;
        } catch (TransformationFailedException|\Exception $e) {
            return null;
        }
    }
}