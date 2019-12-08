<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 08:30
 */

$router = new \lib\FlipRouter(new \lib\FlipRequest());

$router->get('/', function() {
    $conn = new \lib\Mysql\FlipMysqlConnection();
    $conn->connection();
});

$router->post('/disburse', function(\lib\FlipRequest $request) {
    return (new \app\Disbursement\DisbursementController())->storeDisbursement($request->getBody());
});

$router->get('/disburse/{id}', function(\lib\FlipRequest $request) {
    return (new \app\Disbursement\DisbursementController())->checkStatus($request->getBody());
});