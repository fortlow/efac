<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\StatusClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusClient>
 *
 * @method StatusClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusClient[]    findAll()
 * @method StatusClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusClient::class);
    }
}
