<?php

namespace App\Repositories\AccessLevel;


use App\Models\AccessLevel;
use App\Repositories\Repository;

class AccessLevelRepository extends Repository
{
    public function model()
    {
        return AccessLevel::class;
    }

}