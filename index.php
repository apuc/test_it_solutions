<?php

use Kavlar\TestItSolutions\app\controllers\MainController;
use Kavlar\TestItSolutions\app\controllers\TransactionApiController;
use Kavlar\TestItSolutions\app\controllers\UserApiController;

error_reporting(-1);
ini_set("display_errors", true);

const BASE_PATH = __DIR__;

require_once "vendor/autoload.php";

//$user = \Kavlar\TestItSolutions\models\User::findOne(10);

//$transactions = \Kavlar\TestItSolutions\models\Transactions::q()
//    ->select()
//    ->where(['account_from' => 10])
//    ->orWhere("account_to", 10)
//    ->limit(4)
//    ->get();
//
//Debug::dd($transactions);

$routes = [
    '/' => ['method' => 'GET', 'handler' => [MainController::class, 'actionIndex']],
    '/api/user/get-all' => ['method' => 'GET', 'handler' => [UserApiController::class, 'actionGetAll']],
    '/api/transaction/get-by-id' => ['method' => 'GET', 'handler' => [TransactionApiController::class, 'actionGetById']]
];

$router = new \Kavlar\TestItSolutions\router\Router($routes);
$router->dispatch();

