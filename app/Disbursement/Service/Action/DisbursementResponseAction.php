<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 15:30
 */

namespace app\Disbursement\Service\Action;

/**
 * Class DisbursementResponseAction
 *
 * @package app\Disbursement\Service\Action
 */
class DisbursementResponseAction implements DisbursementResponseInterface
{
    const HTTP_CODE_OK = 200;

    /**
     * @var mixed
     */
    protected $response;

    /**
     * @var
     */
    protected $info;

    /**
     * DisbursementResponseAction constructor.
     *
     * @param $response
     * @param $info
     */
    public function __construct($response, $info)
    {
        $this->response = json_decode($response, true);
        $this->info     = $info;
    }

    /**
     * @return int
     */
    public function getStatus() : int
    {
        return $this->info["http_code"] ?? null;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->response ?? [];
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->getStatus() == self::HTTP_CODE_OK;
    }

    /**
     * @return bool
     */
    public function isDecline(): bool
    {
        return $this->getStatus() != self::HTTP_CODE_OK;
    }
}