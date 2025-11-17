<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\RefPaymentMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RefPaymentMethod>
 *
 * @method RefPaymentMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefPaymentMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefPaymentMethod[]    findAll()
 * @method RefPaymentMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefPaymentMethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefPaymentMethod::class);
    }

    public function add(RefPaymentMethod $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RefPaymentMethod $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
