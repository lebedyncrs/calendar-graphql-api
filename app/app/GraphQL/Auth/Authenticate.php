<?php

namespace App\GraphQL\Auth;

use Auth;

trait Authenticate
{
    /**
     * Determine if user authorized
     * @param array $args
     * @return bool
     */
    public function authorize(array $args): bool
    {
        return !Auth::guest();
    }
}