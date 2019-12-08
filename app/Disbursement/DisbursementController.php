<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 15:07
 */

namespace app\Disbursement;

use app\Disbursement\Service\Action\DisbursementCreatorAction;
use app\Disbursement\Transformer\DisbursementTransformer;

/**
 * Class DisbursementController
 */
class DisbursementController
{
    /**
     * @var $creatorAction DisbursementCreatorAction
     */
    protected $creatorAction;

    /**
     * DisbursementController constructor.
     */
    public function __construct()
    {
        $this->creatorAction    = new DisbursementCreatorAction();
    }

    /**
     * @param array $input
     * @return string
     * @throws \Exception
     */
    public function storeDisbursement(array $input) : string
    {
        return (new DisbursementTransformer())->transform($this->creatorAction->process($input));
    }

    /**
     * @param int $transactionID
     * @return array
     */
    public function checkStatus(int $transactionID) : array
    {
        //TODO: check status action
    }
}