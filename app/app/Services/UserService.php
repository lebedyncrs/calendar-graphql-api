<?php

namespace App\Services;

use App\Repositories\User\UserRepository;
use Illuminate\Auth\AuthenticationException;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return array|bool
     */
    public function login(string $email, string $password)
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
}