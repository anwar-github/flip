<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 14:29
 */

namespace app\Disbursement\Service\Action;


interface DisbursementResponseInterface
{
    public function getStatus();

    /**
     * @return array
     */
    public function getData() : array;

    /**
     * @return bool
     */
    public function isSuccess() : bool;

    /**
     * @return bool
     */
    public function isDecline() : bool;
}