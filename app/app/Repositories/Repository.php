<?php

namespace App\Repositories;

use App\Exceptions\NotImplementedException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Repository extends \Bosnadev\Repositories\Eloquent\Repository
{
    /**
     * @var Builder
     */
    protected $model;

    public function model()
    {
        throw new NotImplementedException('Return class name of model');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function one(array $columns = ['*'])
    {
        $this->applyCriteria();
        return $this->model->first($columns);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function softDelete(int $id): bool
    {
        $model = $this->find($id);
        return $model->delete();
    }
}