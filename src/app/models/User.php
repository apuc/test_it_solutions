<?php

namespace Kavlar\TestItSolutions\app\models;

use Kavlar\TestItSolutions\db\Model;

/**
 * @property int $id
 * @property string $name
 */
class User extends Model
{
    public string $table = "users";

    public array $fields = ['id', 'name'];

    /**
     * @return false|array
     */
    public static function getWithTransactions(): false|array
    {
        return User::q()
            ->select("DISTINCT u.id, u.name", "u")
            ->join("user_accounts ua", "u.id = ua.user_id")
            ->join("transactions t", "ua.id = t.account_from OR ua.id = t.account_to")
            ->get();
    }

}