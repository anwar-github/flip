<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-08
 * Time: 12:06
 */

namespace app\Disbursement\Entity\Model;

/**
 * Interface DisbursementInterface
 *
 * @package app\Disbursement\Entity\Model
 */
interface DisbursementInterface extends ModelInterface, HaveLogTimeInterface
{
    /**
     * @return string|null
     */
    public function getTransactionCode() :  ?string ;

    /**
     * @return int|null
     */
    public function getAmount() : ? int ;

    /**
     * @return string|null
     */
    public function getStatus() : ?string ;

    /**
     * @return string|null
     */
    public function getBankCode() : ?string ;

    /**
     * @return string|null
     */
    public function getAccountNumber() : ?string ;

    /**
     * @return string|null
     */
    public function getBeneficiaryName() : ?string ;

    /**
     * @return string|null
     */
    public function getRemark() : ?string ;

    /**
     * @return string|null
     */
    public function getReceipt() : ?string ;

    /**
     * @return string|null
     */
    public function getFee() : ?string ;
}