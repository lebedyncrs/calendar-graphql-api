<?php

namespace App\Repositories\Calendar;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Criteria\Criteria;

class IdInCriteria extends Criteria
{
    /**
     * @var array
     */
    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function apply($queryBuilder, RepositoryInterface $repository)
    {
        return $queryBuilder->whereIn('id', $this->ids);
    }
}