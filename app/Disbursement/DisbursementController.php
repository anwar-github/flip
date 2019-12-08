<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 15:07
 */

namespace app\Disbursement;

use app\Disbursement\Service\Action\DisbursementCheckStatusAction;
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
     * @var $checkStatus DisbursementCheckStatusAction
     */
    protected $checkStatus;

    /**
     * DisbursementController constructor.
     */
    public function __construct()
    {
        $this->creatorAction    = new DisbursementCreatorAction();
        $this->checkStatus      = new DisbursementCheckStatusAction();
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
     * @param int $transactionCode
     * @return string
     */
    public function checkStatus(int $transactionCode) : string
    {
        return (new DisbursementTransformer())->transform($this->checkStatus->process([
            'transaction_code'  => $transactionCode
        ]));
    }
}