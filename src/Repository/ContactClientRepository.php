<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\ContactClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactClient>
 *
 * @method ContactClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactClient[]    findAll()
 * @method ContactClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactClient::class);
    }

    public function add(ContactClient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ContactClient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
