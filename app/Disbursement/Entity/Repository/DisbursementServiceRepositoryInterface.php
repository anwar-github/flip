<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 13:56
 */

namespace app\Disbursement\Entity\Repository;

use lib\Mysql\FlipRepositoryInterface;

/**
 * Interface DisbursementServiceRepositoryInterface
 *
 * @package DisbursementServiceRepository
 */
interface DisbursementServiceRepositoryInterface extends FlipRepositoryInterface
{
    const table = 'disbursement';
}