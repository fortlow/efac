<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\RefStatusBill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RefStatusBill>
 *
 * @method RefStatusBill|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefStatusBill|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefStatusBill[]    findAll()
 * @method RefStatusBill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefStatusBillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefStatusBill::class);
    }
}
