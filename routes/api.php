<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 08:30
 */

$router = new \lib\FlipRouter(new \lib\FlipRequest());

$router->get('/', function() {
    return json_encode([
        'api'       => 'flip',
        'version'   => 1.0,
        'status'    => 'green'
    ]);
});

$router->post('/disburse', function(\lib\FlipRequest $request) {
    return (new \app\Disbursement\DisbursementController())->storeDisbursement($request->getBody());
});

$router->get('/disburse/{id}', function(\lib\FlipRequest $request) {
    return (new \app\Disbursement\DisbursementController())->checkStatus($request->getBody());
});