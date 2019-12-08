<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 08:00
 */

namespace app\Disbursement\Entity\Repository;

use app\Disbursement\Entity\Model\DisbursementModel as Model;
use lib\Mysql\FlipRepository as Repository;

/**
 * Class DisbursementServiceRepository
 *
 * @package app\Disbursement\Entity\Repository
 */
class DisbursementServiceRepository extends Repository implements DisbursementServiceRepositoryInterface
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Model::class;
    }
}