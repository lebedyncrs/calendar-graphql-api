<?php

namespace App\GraphQL\Errors;

use GraphQL\Error\Error;

class PermissionDeniedError extends Error
{
    public function __construct()
    {
        parent::__construct('Permission denied');
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return 403;
    }
}