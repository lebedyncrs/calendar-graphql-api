<?php

namespace App\Repositories\Calendar;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Criteria\Criteria;

class OwnerEqualCriteria extends Criteria
{
    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function apply($queryBuilder, RepositoryInterface $repository)
    {
        return $queryBuilder->where('owner_id', $this->id);
    }
}