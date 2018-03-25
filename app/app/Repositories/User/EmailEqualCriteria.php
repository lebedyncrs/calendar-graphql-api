<?php

namespace App\Repositories\User;


use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Criteria\Criteria;

class EmailEqualCriteria extends Criteria
{
    protected $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function apply($queryBuilder, RepositoryInterface $repository)
    {
        return $queryBuilder->whereEmail($this->email);
    }
}