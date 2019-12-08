<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-08
 * Time: 12:36
 */

namespace app\Disbursement\Entity\Model;

/**
 * Interface HaveLogTimeInterface
 *
 * @package app\Disbursement\Entity\Model
 */
interface HaveLogTimeInterface
{
    /**
     * @return string|null
     */
    public function getCreatedAt() : ?string ;

    /**
     * @return string|null
     */
    public function getUpdatedAt() : ?string ;
}