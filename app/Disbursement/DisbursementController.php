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
        try {
            return (new DisbursementTransformer())->transform($this->creatorAction->process($input));
        } catch (\Exception $exception) {
            return json_encode([
                'status'    => 'ERROR',
                'message'   => $exception->getMessage()
            ], JSON_PRETTY_PRINT);
        }
    }

    /**
     * @param int $transactionCode
     * @return string
     * @throws \Exception
     */
    public function checkStatus(int $transactionCode) : string
    {
        try {
            return (new DisbursementTransformer())->transform($this->checkStatus->process([
                'transaction_code'  => $transactionCode
            ]));
        } catch (\Exception $exception) {
            return json_encode([
                'status'    => 'ERROR',
                'message'   => $exception->getMessage()
            ], JSON_PRETTY_PRINT);
        }
    }
}