<?php

namespace App\Services;

use App\Repositories\User\UserRepository;
use Illuminate\Auth\AuthenticationException;

class UserService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $email
     * @param string $password
     * @throws AuthenticationException
     * @return array
     */
    public function login(string $email, string $password): array
    {
        $token = auth()->attempt(['email' => $email, 'password' => $password]);

        if (!$token) {
            throw new AuthenticationException();
        }
        return [
            'token' => $token,
            'user' => auth()->user()
        ];
    }

    /**
     * Create new user.
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $data['password'] = bcrypt($data['password']);
        return $this->repository->create($data);
    }
}