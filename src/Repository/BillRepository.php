<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Bill;
use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bill>
 *
 * @method Bill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bill::class);
    }
    /**
     * @param Bill $entity
     * @param bool $flush
     * @return void
     */
    public function add(Bill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @param Bill $entity
     * @param bool $flush
     * @return void
     */
    public function remove(Bill $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @return array  Returns an array of Bill objects
     */
    public function findBillClientClassic(): array
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.created_at', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return array  Returns an array of Bill objects
     */
    public function findBillClientBlr(): array
    {
        return $this->createQueryBuilder('b')
            ->where('b.service_blr IS NOT NULL')
            ->orderBy('b.created_at', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByClientAndPeriod(Client $client, string $period): array
    {
        return $this->createQueryBuilder('b')
            ->where('b.client = :val1')
            ->andWhere('b.period = :val2')
            ->setParameter('val1', $client)
            ->setParameter('val2', $period)
            ->orderBy('b.created_at', 'DESC')
            ->getQuery()
            ->getResult()
            ;

    }

    public function findAll(): array
    {
        return $this->findBy([], ['created_at' => 'DESC']);
    }
}
