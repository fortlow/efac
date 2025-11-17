<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\IntercalProforma;
use App\Entity\Proforma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IntercalProforma>
 *
 * @method IntercalProforma|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntercalProforma|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntercalProforma[]    findAll()
 * @method IntercalProforma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntercalProformaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IntercalProforma::class);
    }
    /**
     * @param Proforma $proforma
     * @return void
     * @throws Exception
     */
    public function removeIntercalProforma(Proforma $proforma): void
    {
        $cmd = $this->getEntityManager()->getClassMetadata('App\Entity\IntercalProforma');
        $cnx = $this->getEntityManager()->getConnection();
        try {
            $cnx->query('DELETE FROM '. $cmd->getTableName() .' WHERE proforma_id = '. $proforma->getId());
        } catch (\Exception $e) {
            //dump('Exception - removeIntercalProforma ', $e->getMessage());
            $cnx->rollBack();
        }
    }
}
