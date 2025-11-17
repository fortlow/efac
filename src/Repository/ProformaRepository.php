<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Proforma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Proforma>
 *
 * @method Proforma|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proforma|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proforma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProformaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proforma::class);
    }

    public function add(Proforma $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Proforma $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAll(): array
    {
        return $this->findBy([], ['created_at' => 'DESC']);
    }
}
