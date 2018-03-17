<?php

namespace App\GraphQL;

use App\GraphQL\Errors\AuthorizationError;
use GraphQL\Error\Error;
use Rebing\GraphQL\Error\ValidationError;

class GraphQL extends \Rebing\GraphQL\GraphQL
{
    public static function formatError(Error $e)
    {
        $error = [
            'message' => $e->getMessage()
        ];

        $previous = $e->getPrevious();
        if ($previous && $previous instanceof ValidationError) {
            $error['http_code'] = 422;
            $error['validation'] = $previous->getValidatorMessages();
        } elseif ($previous && $previous instanceof AuthorizationError) {
            $error['http_code'] = 401;
        } else {
            $locations = $e->getLocations();
            if (!empty($locations)) {
                $error['locations'] = array_map(function ($loc) {
                    return $loc->toArray();
                }, $locations);
            }
        }

        return $error;
    }
}