<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\IntercalBill;
use App\Entity\Bill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IntercalBill>
 *
 * @method IntercalBill|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntercalBill|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntercalBill[]    findAll()
 * @method IntercalBill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntercalBillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IntercalBill::class);
    }
    /**
     * @param Bill $bill
     * @return void
     * @throws Exception
     */
    public function removeIntercalaireBill(Bill $bill): void
    {
        $cmd = $this->getEntityManager()->getClassMetadata('App\Entity\IntercalBill');
        $cnx = $this->getEntityManager()->getConnection();
        try {
            $cnx->query('DELETE FROM '. $cmd->getTableName() .' WHERE bill_id = '. $bill->getId());
        } catch (\Exception $e) {
            //dump('Exception - removeIntercalaireBill ', $e->getMessage());
            $cnx->rollBack();
        }
    }
}
