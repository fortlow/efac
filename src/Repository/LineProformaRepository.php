<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\LineProforma;
use App\Entity\Proforma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LineProforma>
 *
 * @method LineProforma|null find($id, $lockMode = null, $lockVersion = null)
 * @method LineProforma|null findOneBy(array $criteria, array $orderBy = null)
 * @method LineProforma[]    findAll()
 * @method LineProforma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LineProformaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LineProforma::class);
    }

    public function add(LineProforma $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LineProforma $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * @param Proforma $proforma
     * @return void
     * @throws Exception
     */
    public function removeLineProforma(Proforma $proforma): void
    {
        $cmd = $this->getEntityManager()->getClassMetadata('App\Entity\LineProforma');
        $cnx = $this->getEntityManager()->getConnection();
        try {
            $cnx->query('DELETE FROM '. $cmd->getTableName() .' WHERE proforma_id = '. $proforma->getId());
        } catch (\Exception $e) {
            dump('Exception - removeLineProforma ', $e->getMessage());
            $cnx->rollBack();
        }
    }
}
