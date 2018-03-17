<?php

namespace App\GraphQL\Errors;

use GraphQL\Error\Error;

class AuthorizationError extends Error
{
    public function __construct()
    {
        parent::__construct('Login or password are wrong');
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return 401;
    }
}