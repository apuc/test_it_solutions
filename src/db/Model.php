<?php

namespace Kavlar\TestItSolutions\db;

#[\AllowDynamicProperties]class Model
{


    public string $table;
    public array $fields = [];

    public function __construct()
    {

    }

    public function load(array $data): void
    {
        foreach ($this->fields as $key){
            if (isset($data[$key])){
                $this->{$key} = $data[$key];
            }
        }
    }

    public static function findOne(int $id): static|bool
    {
        return static::q()->select()->where(['id' => $id])->first();
    }

    public static function all(): false|array
    {
        return static::q()->select()->get();
    }

    public static function q(): Query
    {
        return new Query(static::class);
    }

}