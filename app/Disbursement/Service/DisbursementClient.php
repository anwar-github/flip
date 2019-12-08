<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 14:05
 */

namespace app\Disbursement\Service;

use app\Disbursement\Service\Action\DisbursementResponseAction;
use app\Disbursement\Service\Action\DisbursementResponseInterface;

/**
 * Class DisbursementClient
 *
 * @package app\Disbursemen\Service
 */
class DisbursementClient
{
    const METHOD_POST   = 1;
    const METHOD_GET    = 0;

    /**
     * @param string $path
     * @param string $payload
     * @param array $option
     * @return DisbursementResponseInterface
     */
    public function http(string $path, string $payload, array $option= []) : DisbursementResponseInterface
    {
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,'https://nextar.flip.id' . $path);
            curl_setopt($ch, CURLOPT_POST, $option['method'] ?? '');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $option['header'] ?? '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_USERPWD, $option['auth'] . ':' . '');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);

            $server_output = curl_exec($ch);
            if (curl_errno($ch)) {
                $error_msg = curl_error($ch);
            }
            $info = curl_getinfo($ch);
            curl_close ($ch);


            return new DisbursementResponseAction($server_output, $info);
        } catch (\Exception $exception) {
            var_dump(2, $exception);
        }
    }
}