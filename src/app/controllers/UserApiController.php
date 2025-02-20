<?php

namespace Kavlar\TestItSolutions\app\controllers;

use JetBrains\PhpStorm\NoReturn;
use Kavlar\TestItSolutions\ApiController;

class UserApiController extends ApiController
{

    #[NoReturn] public function actionGetAll(): void
    {
        $users = \Kavlar\TestItSolutions\app\models\User::getWithTransactions();

        $this->renderApi($users);
    }

}