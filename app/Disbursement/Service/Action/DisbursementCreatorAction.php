<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 14:05
 */

namespace app\Disbursement\Service\Action;

use app\Disbursement\Entity\Repository\DisbursementServiceRepository;

/**
 * Class DisbursementCreatorAction
 *
 * @package app\Disbursemen\Service\Action
 */
class DisbursementCreatorAction extends AbstractDisbursementAction
{
    const PATH          = '/disburse';
    const CONTENT_TYPE  = 'application/x-www-form-urlencoded';
    const AUTH_TYPE     = 'basic';
    const METHOD        = 'POST';
    const HTTP_VERSION  = 'HTTP/1.1';
    /**
     * @param array $input
     * @return bool
     */
    public function validate(array $input): bool
    {
        // TODO: Implement validate() method.
        return true;
    }

    /**
     * @param array $input
     * @return string
     */
    public function generateRequest(array $input): string
    {
        return http_build_query($input);
    }

    /**
     * @param string $payload
     * @return DisbursementResponseInterface
     * @throws \Exception
     */
    public function handle(string $payload): DisbursementResponseInterface
    {
        return $this->http(self::PATH, $payload, [
            'header'    => [
                'Content-Type'  => 'application/x-www-form-urlencoded',
            ],
            'auth'      => 'HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41',
            'method'    => self::METHOD_POST
        ]);
    }

    /**
     * @param DisbursementResponseInterface $disbursementResponse
     * @return array|object
     */
    public function handleSuccess(DisbursementResponseInterface $disbursementResponse)
    {
        return $this->repository->create(array_merge($disbursementResponse->getData(), [ 'transaction_code' => $disbursementResponse->getData()['id']]));
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