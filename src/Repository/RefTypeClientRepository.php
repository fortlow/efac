<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\RefTypeClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RefTypeClient>
 *
 * @method RefTypeClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method RefTypeClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method RefTypeClient[]    findAll()
 * @method RefTypeClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RefTypeClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefTypeClient::class);
    }
}
