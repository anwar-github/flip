<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 14:05
 */

namespace app\Disbursement\Service\Action;

use app\Disbursement\Entity\Model\ModelInterface;
use app\Disbursement\Entity\Repository\DisbursementServiceRepository;
use app\Disbursement\Service\DisbursementClient;

/**
 * Class AbstractDisbursementAction
 */
abstract class AbstractDisbursementAction extends DisbursementClient
{
    /**
     * @var DisbursementServiceRepository $repository
     */
    protected $repository;

    /**
     * AbstractDisbursementAction constructor.
     */
    public function __construct()
    {
        $this->repository = new DisbursementServiceRepository();
    }

    /**
     * @param array $input
     * @return array|mixed
     */
    public function process(array $input)
    {
        try {
            $this->validate($input);
            $payload    = $this->generateRequest($input);
            // $this->logRequest($payload);
            $response   = $this->handle($payload);
            // $this->logResponse($payload, $response);

            if ($response->isSuccess()) return $this->handleSuccess($response);
            if ($response->isDecline()) return $this->handleDecline($response);

            return $this->handleTimeOut($response);

        } catch (\Exception $exception) {
            //TODO: handle exception
        }
    }

    /**
     * @param array $input
     * @return bool
     */
    abstract function validate(array $input) : bool;

    /**
     * @param array $input
     * @return string
     */
    abstract function generateRequest(array $input) : string ;

    /**
     * @param string $payload
     * @return DisbursementResponseInterface
     */
    abstract function handle(string $payload) : DisbursementResponseInterface;

    /**
     * @param DisbursementResponseInterface $disbursementResponse
     * @return ModelInterface
     */
    abstract function handleSuccess(DisbursementResponseInterface $disbursementResponse);

    /**
     * @param DisbursementResponseInterface $disbursementResponse
     * @return array
     */
    abstract function handleDecline(DisbursementResponseInterface $disbursementResponse) : array ;

    /**
     * @param $exception
     * @return mixed
     */
    abstract function handleTimeOut($exception);

    /**
     * @param array $request
     * @return array
     */
    protected function logRequest(array $request) : array
    {
        //TODO: log request
        return [];
    }

    /**
     * @param array $request
     * @param DisbursementResponseInterface $disbursementResponse
     * @return array
     */
    protected function logResponse(array $request, DisbursementResponseInterface $disbursementResponse) : array
    {
        //TODO: log response
        return [];
    }

}