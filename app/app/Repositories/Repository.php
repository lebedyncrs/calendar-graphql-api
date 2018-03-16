<?php

namespace App\Repositories;

use App\Exceptions\NotImplementedException;

class Repository extends \Bosnadev\Repositories\Eloquent\Repository
{
    public function model()
    {
        throw new NotImplementedException('Return class name of model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function one()
    {
        $this->applyCriteria();
        return $this->model->first();
    }
}