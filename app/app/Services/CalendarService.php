<?php

namespace App\Services;

use App\Models\CalendarShare;
use App\Repositories\Calendar\CalendarRepository;

class CalendarService
{
    /**
     * @var CalendarRepository
     */
    protected $repository;

    /**
     * CalendarService constructor.
     * @param CalendarRepository $repository
     */
    public function __construct(CalendarRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return CalendarRepository
     */
    public function getRepository(): CalendarRepository
    {
        return $this->repository;
    }

    /**
     * Create new entity.
     * @param array $data
     * @return array
     */
    public function create(array $data): CalendarShare
    {
        $data['calendars_id'] = auth()->user()->calendar->id;
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