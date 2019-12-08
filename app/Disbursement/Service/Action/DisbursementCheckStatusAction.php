<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 16:27
 */

namespace app\Disbursement\Service\Action;

use app\Disbursement\Entity\Model\DisbursementInterface;
use app\Disbursement\Entity\Model\ModelInterface;

/**
 * Class DisbursementCheckStatusAction
 *
 * @package app\Disbursement\Service\Action
 */
class DisbursementCheckStatusAction extends AbstractDisbursementAction
{
    const PATH          = '/disburse';
    const CONTENT_TYPE  = 'application/x-www-form-urlencoded';
    const AUTH_TYPE     = 'basic';
    const METHOD        = 'POST';
    const HTTP_VERSION  = 'HTTP/1.1';

    /**
     * @param array $input
     * @return bool
     * @throws \Exception
     */
    public function validate(array $input): bool
    {
        /**
         * @var $transaction DisbursementInterface
         */
        $transaction = $this->repository->findBy('transaction_code', (int) $input['transaction_code']);
        if (is_null($transaction)) throw new \Exception('data not found ' . $input['transaction_code']);

        return true;
    }

    /**
     * @param array $input
     * @return string
     */
    public function generateRequest(array $input): string
    {
        return (int) $input['transaction_code'];
    }

    /**
     * @param string $payload
     * @return DisbursementResponseInterface
     * @throws \Exception
     */
    public function handle(string $payload): DisbursementResponseInterface
    {
        return $this->http(self::PATH . '/' . $payload, $payload, [
            'header'    => [
                'Content-Type'  => 'application/x-www-form-urlencoded',
            ],
            'auth'      => 'HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41',
            'method'    =>  self::METHOD_GET
        ]);
    }

    /**
     * @param DisbursementResponseInterface $disbursementResponse
     * @return ModelInterface|array
     */
    public function handleSuccess(DisbursementResponseInterface $disbursementResponse)
    {
        $data = $disbursementResponse->getData();
        return $this->repository->update([
            'status'        => $data['status'],
            'receipt'       => $data['receipt'],
            'time_served'   => $data['time_served']
        ], [
            'transaction_code' => $data['id']
        ]);
    }

    /**
     * @param DisbursementResponseInterface $disbursementResponse
     * @return array
     */
    public function handleDecline(DisbursementResponseInterface $disbursementResponse): array
    {
        return $disbursementResponse->getData();
    }

    /**
     * @param $exception
     * @return mixed|void
     */
    public function handleTimeOut($exception)
    {
        // TODO: Implement handleTimeOut() method.
    }
}