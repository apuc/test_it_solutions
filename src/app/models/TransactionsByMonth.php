<?php

namespace Kavlar\TestItSolutions\app\models;

use Kavlar\TestItSolutions\app\models\Transactions;

class TransactionsByMonth extends Transactions
{

    public array $fields = ['month', 'income', 'outcome'];

}