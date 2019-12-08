<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-08
 * Time: 11:45
 */

namespace app\Disbursement\Transformer;

use app\Disbursement\Entity\Model\DisbursementModel;

/**
 * Class DisbursementTransformer
 */
class DisbursementTransformer
{
    /**
     * @param DisbursementModel $disbursement
     * @return string
     */
    public function transform(? DisbursementModel $disbursement) : string
    {
        try {
            return json_encode([
                'data'      => [
                    'transaction_id'    => $disbursement->getTransactionCode(),
                    'amount'            => $disbursement->getAmount(),
                    'status'            => $disbursement->getStatus(),
                    'time_served'       => $disbursement->getTimeServed(),
                    'bank_code'         => $disbursement->getBankCode(),
                    'account_number'    => $disbursement->getAccountNumber(),
                    'beneficiary_name'  => $disbursement->getBeneficiaryName(),
                    'remark'            => $disbursement->getRemark(),
                    'receipt'           => $disbursement->getReceipt(),
                    'fee'               => $disbursement->getFee(),
                    'created_at'        => $disbursement->getCreatedAt(),
                    'updated_at'        => $disbursement->getUpdatedAt()
                ]
            ], JSON_PRETTY_PRINT);
        } catch (\Exception $exception) {
            return json_encode([
                'status'    => 'ERROR',
                'message'   => $exception->getMessage()
            ], JSON_PRETTY_PRINT);
        }
    }

}