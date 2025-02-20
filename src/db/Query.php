<?php

namespace Kavlar\TestItSolutions\db;

use InvalidArgumentException;
use Itguild\Debug\Debug;

class Query
{
    protected string $queryWhereString = "";
    protected string $querySelectString = "";
    protected string $queryOrderByString = "";
    protected string $queryGroupByString = "";
    protected string $queryLimitOffsetString = "";
    protected string $queryJoinString = "";

    protected array $prepareArr = [];

    public string $queryString = "";
    public Model $model;

    public string $modelClass;
    protected DB $DB;

    public function __construct(string $model)
    {
        $this->modelClass = $model;
        $this->model = new $model();
        $this->DB = DB::getInstance();
    }

    public function select(string $fields = "*", string $as = ""): static
    {
        $table = $this->model->table;
        $this->querySelectString = "SELECT $fields FROM $table $as";

        return $this;
    }

    public function where(array $data): static
    {
        $first = 1;
        $this->queryWhereString = " WHERE ";
        foreach ($data as $key => $datum){
            if (!$first){
                $this->queryWhereString .= " AND ";
            }
            if (is_numeric($datum)){
                $this->queryWhereString .= "$key = :$key";
            }
            elseif (is_string($datum)){
                $this->queryWhereString .= "$key LIKE :$key";
            }
            $this->prepareArr[$key] = $datum;
            $first = 0;
        }

        return $this;
    }

    public function orWhere(string $column, string|int $value, bool $exactOccurrence = false): static
    {
        $this->queryWhereString .= " OR ";
        if (is_numeric($value)){
            $this->queryWhereString .= "$column = :$column";
        }
        elseif (is_string($value)){
            if ($exactOccurrence){
                $this->queryWhereString .= "$column LIKE :$column";
            }
            else {
                $this->queryWhereString .= "$column LIKE %:$column%";
            }
        }
        $this->prepareArr[$column] = $value;

        return $this;
    }

    public function join(string $column, string $on): static
    {
        $this->queryJoinString .= " JOIN " . $column . " ON " . $on;

        return $this;
    }

    public function orderBy(string $column, string $sorting = "ASC"): static
    {
        //$column = $this->whiteList($column, $this->model->fields, "Invalid field name");
        $sorting = $this->whiteList($sorting, ["ASC","DESC"], "Invalid ORDER BY direction");
        $this->queryOrderByString = " ORDER BY $column $sorting";

        return $this;
    }

    public function groupBy(string $column): static
    {
        $this->queryGroupByString = " GROUP BY $column";

        return $this;
    }

    public function limit(int $limit): static
    {
        $this->queryLimitOffsetString = " LIMIT :limit";
        $this->prepareArr['limit'] = $limit;

        return $this;
    }

    public function offset(int $offset): static
    {
        $this->queryLimitOffsetString = " OFFSET :offset";
        $this->prepareArr['offset'] = $offset;

        return $this;
    }

    public function getQuery(): string
    {
        $this->queryString = $this->querySelectString .
            $this->queryJoinString .
            $this->queryWhereString .
            $this->queryGroupByString .
            $this->queryOrderByString .
            $this->queryLimitOffsetString;

        return $this->queryString;
    }

    public function get(): false|array
    {
        $this->queryString = $this->querySelectString .
            $this->queryJoinString .
            $this->queryWhereString .
            $this->queryGroupByString .
            $this->queryOrderByString .
            $this->queryLimitOffsetString;
        if (!empty($this->querySelectString)){
            $q = $this->DB->get_connect()->prepare($this->queryString);
            $q->execute($this->prepareArr);
            $data = $q->fetchAll();
            $resArr = [];
            foreach ($data as $datum){
                $model = new $this->modelClass();
                $model->load($datum);
                $resArr[] = $model;
            }

            return $resArr;
        }

        return false;
    }

    public function first(): Model|bool
    {
        $this->queryString = $this->querySelectString . $this->queryWhereString . $this->queryOrderByString . " LIMIT 1";
        if (!empty($this->querySelectString)){
            $q = $this->DB->get_connect()->prepare($this->queryString);
            $q->execute($this->prepareArr);
            $model = new $this->modelClass();
            $model->load($q->fetch());

            return $model;
        }

        return false;
    }

    protected function whiteList(&$value, $allowed, $message)
    {
        if ($value === null) {
            return $allowed[0];
        }
        $key = array_search($value, $allowed, true);
        if ($key === false) {
            throw new InvalidArgumentException($message);
        } else {
            return $value;
        }
    }

}