<?php

namespace Kavlar\TestItSolutions\app\controllers;

use JetBrains\PhpStorm\NoReturn;
use Kavlar\TestItSolutions\ApiController;
use Kavlar\TestItSolutions\app\models\TransactionsByMonth;

class TransactionApiController extends ApiController
{

    #[NoReturn] public function actionGetById(): void
    {
        $userId = $_GET['user_id'];
        $transaction = TransactionsByMonth::q()
            ->select("strftime('%Y-%m', t.trdate) AS month,
    SUM(CASE WHEN ua.user_id = :user_id AND t.account_to = ua.id THEN t.amount ELSE 0 END) AS income,
    SUM(CASE WHEN ua.user_id = :user_id AND t.account_from = ua.id THEN t.amount ELSE 0 END) AS outcome,
    COUNT(DISTINCT DATE(t.trdate)) AS days_with_transactions", "t")
            ->join("user_accounts ua", "ua.id = t.account_from OR ua.id = t.account_to")
            ->where(["user_id" => $userId])
            ->groupBy("strftime('%Y-%m', t.trdate)")
            ->orderBy("month")
            ->get();

        $this->renderApi($transaction);
    }

}