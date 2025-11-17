<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\RefService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RefService>
 *
 * @method RefService|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefService|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefService[]    findAll()
 * @method RefService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefService::class);
    }

    public function add(RefService $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RefService $entity, bool $flush = false): void
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
