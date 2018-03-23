<?php

namespace App\Services;

use App\Repositories\EventRepository;

class EventService
{
    /**
     * @var EventRepository
     */
    protected $repository;

    /**
     * EventService constructor.
     * @param EventRepository $repository
     */
    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return EventRepository
     */
    public function getRepository(): EventRepository
    {
        return $this->repository;
    }

    /**
     * Create new user.
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $data['owner_id'] = auth()->user()->id;
        return $this->repository->create($data)->toArray();
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
     * @return mixed
     */
    public function softDelete(int $id)
    {
        return $this->repository->softDelete($id);
    }

    public function hasPermissionToUpdate(int $eventId, int $userId): bool
    {
        return $this->repository->find($eventId)->isOwner($userId);
    }
}