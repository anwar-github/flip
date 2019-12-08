<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-08
 * Time: 09:50
 */

namespace app\Disbursement\Entity\Model;

/**
 * Class DisbursementModel
 */
class DisbursementModel implements DisbursementInterface
{
    use HaveLogTimeTrait;

    /**
     * @var string
     */
    public $database = 'disbursment_db';
    /**
     * @var string
     */
    public $table = 'transaction';

    /**
     * @var array
     */
    public $fillable =  [
        'transaction_code',
        'amount',
        'status',
        'time_served',
        'bank_code',
        'account_number',
        'beneficiary_name',
        'remark',
        'receipt',
        'fee',
        'created_at',
        'updated_at'
    ];

    /**
     * @inheritdoc
     */
    public function getTransactionCode(): ?string
    {
        return $this->data->transaction_code;
    }

    /**
     * @inheritdoc
     */
    public function getAmount(): ?int
    {
        return $this->data->amount;
    }

    /**
     * @inheritdoc
     */
    public function getStatus(): ?string
    {
        return $this->data->status;
    }

    /**
     * @inheritdoc
     */
    public function getTimeServed(): ?string
    {
        return $this->data->time_served;
    }

    /**
     * @inheritdoc
     */
    public function getBankCode(): ?string
    {
        return $this->data->bank_code;
    }

    /**
     * @inheritdoc
     */
    public function getAccountNumber(): ?string
    {
        return $this->data->account_number;
    }

    /**
     * @inheritdoc
     */
    public function getBeneficiaryName(): ?string
    {
        return $this->data->beneficiary_name;
    }

    /**
     * @inheritdoc
     */
    public function getRemark(): ?string
    {
        return $this->data->remark;
    }

    /**
     * @inheritdoc
     */
    public function getReceipt(): ?string
    {
        return $this->data->receipt;
    }

    /**
     * @inheritdoc
     */
    public function getFee(): ?string
    {
        return $this->data->fee;
    }

}