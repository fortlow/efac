<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\RefProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RefProduct>
 *
 * @method RefProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefProduct[]    findAll()
 * @method RefProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefProduct::class);
    }

    public function add(RefProduct $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RefProduct $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAll(): array
    {
        return $this->findBy([], ['name' => 'ASC']);
    }
}
