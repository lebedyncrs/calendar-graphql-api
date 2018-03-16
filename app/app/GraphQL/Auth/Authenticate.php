<?php

namespace App\GraphQL\Auth;

use Auth;

trait Authenticate
{
    public function authorize(array $args)
    {
        return !Auth::guest();
    }
}