<?php

namespace App\Services;

use App\Models\CalendarShare;
use App\Repositories\CalendarShare\CalendarShareRepository;

class CalendarShareService
{
    /**
     * @var CalendarShareRepository
     */
    protected $repository;

    /**
     * CalendarShareService constructor.
     * @param CalendarShareRepository $repository
     */
    public function __construct(CalendarShareRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return CalendarShareRepository
     */
    public function getRepository(): CalendarShareRepository
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