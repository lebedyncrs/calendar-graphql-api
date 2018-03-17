<?php

namespace App\GraphQL\Errors;

use GraphQL\Error\Error;

class AuthorizationError extends Error
{
    public function __construct()
    {
        parent::__construct('Login or password are wrong');
    }

    public function getHttpCode()
    {
        return 401;
    }
}