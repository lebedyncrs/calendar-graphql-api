<?php

namespace App\GraphQL;

use App\GraphQL\Errors\AuthorizationError;
use App\GraphQL\Errors\PermissionDeniedError;
use GraphQL\Error\Error;
use Rebing\GraphQL\Error\ValidationError;

class GraphQL extends \Rebing\GraphQL\GraphQL
{
    /**
     * Format error structure
     * @todo include stack trace in case of system errors
     * @param Error $e
     * @return array
     */
    public static function formatError(Error $e): array
    {
        $error = [
            'message' => $e->getMessage()
        ];

        $previous = $e->getPrevious();
        if ($previous && $previous instanceof ValidationError) {
            $error['http_code'] = 422;
            $error['validation'] = $previous->getValidatorMessages();
        } elseif ($previous && $previous instanceof AuthorizationError || $previous instanceof PermissionDeniedError) {
            $error['http_code'] = $previous->getHttpCode();
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