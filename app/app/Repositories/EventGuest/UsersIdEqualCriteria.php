<?php

namespace App\Repositories\EventGuest;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Criteria\Criteria;

class UsersIdEqualCriteria extends Criteria
{
    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function apply($queryBuilder, RepositoryInterface $repository)
    {
        return $queryBuilder->whereUsersId($this->id);
    }
}