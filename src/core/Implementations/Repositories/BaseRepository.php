<?php

namespace Core\Implementations\Repositories;

use Core\Data\Repositories\BaseRepositoryContract;
use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;


class BaseRepository implements BaseRepositoryContract
{
    protected EloquentQueryBuilder|QueryBuilder $queryBuilder;
    protected string $modelClass;

    public function __construct()
    {
        $this->queryBuilder = $this->getQueryBuilder();
    }

    public function getQueryBuilder(): EloquentQueryBuilder|QueryBuilder 
    {
        $this->modelClass = "Core\Implementations\Entities\\$this->modelClass"; 
        return app($this->modelClass)->newQuery();
    }
}
