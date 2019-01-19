<?php
/**
 * Created by PhpStorm.
 * User: eqinex
 * Date: 19.01.19
 * Time: 21:34
 */

namespace App\Repository;

class DotaBoostOrderRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param $filters
     * @param int $currentPage
     * @param int $perPage
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getAvailableOrders($filters, $currentPage = 1, $perPage = 20)
    {
        $qb = $this->createQueryBuilder('dbo');

        $qb->select('dbo');

        return $qb->getQuery()->getResult();
    }
}