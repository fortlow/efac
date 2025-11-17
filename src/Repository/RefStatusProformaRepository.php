<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\RefStatusProforma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RefStatusProforma>
 *
 * @method RefStatusProforma|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefStatusProforma|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefStatusProforma[]    findAll()
 * @method RefStatusProforma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefStatusProformaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefStatusProforma::class);
    }
}
