<?php

namespace App\Services;

use App\Repositories\EventGuest\EventGuestRepository;
use App\Repositories\EventGuest\UsersIdEqualCriteria;

class EventGuestService
{
    /**
     * @var EventGuestRepository
     */
    protected $repository;

    /**
     * EventGuestService constructor.
     * @param EventGuestRepository $repository
     */
    public function __construct(EventGuestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return EventGuestRepository
     */
    public function getRepository(): EventGuestRepository
    {
        return $this->repository;
    }

    /**
     * Invite new user to event.
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $data['is_organizer'] = $data['users_id'] == auth()->user()->id;
        return $this->repository->create($data)->toArray();
    }

    /**
     * Update existing invitation
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

    /**
     * @param int $eventId
     * @param int $userId
     * @return bool
     */
    public function hasPermissionToUpdate(int $eventId, int $userId): bool
    {
        $model = $this->repository->pushCriteria(new UsersIdEqualCriteria($userId))->one();
        return $model->isOrganizer($userId);
    }
}