<?php

namespace Kavlar\TestItSolutions\app\models;

use Kavlar\TestItSolutions\db\Model;

class Transactions extends Model
{

    public string $table = "transactions";

    public array $fields = ['id', 'account_from', 'account_to', 'amount', 'trdate', 'month'];

}