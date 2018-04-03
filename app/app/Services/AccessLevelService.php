<?php

namespace App\Services;

use App\Models\AccessLevel;
use App\Repositories\AccessLevel\AccessLevelRepository;

class AccessLevelService
{
    /**
     * @var AccessLevelRepository
     */
    protected $repository;

    /**
     * AccessLevelService constructor.
     * @param AccessLevelRepository $repository
     */
    public function __construct(AccessLevelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return AccessLevelRepository
     */
    public function getRepository(): AccessLevelRepository
    {
        return $this->repository;
    }

    /**
     * Create new entity.
     * @param array $data
     * @return AccessLevel
     */
    public function create(array $data): AccessLevel
    {
        return $this->repository->create($data);
    }

    /**
     * @param array $data
     * @return int
     */
    public function update(array $data): int
    {
        return $this->repository->updateRich($data, $data['id']);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function softDelete(int $id): bool
    {
        return $this->repository->softDelete($id);
    }

    public function hasPermissionToUpdate(int $eventId, int $userId): bool
    {
        return $this->repository->find($eventId)->isOwner($userId);
    }
}