<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestResponse;
use PHPUnit\Framework\Assert as PHPUnit;
use Illuminate\Support\Arr;

class GraphQLTestResponse extends TestResponse
{
    /**
     * @inheritdoc
     */
    public function assertJsonValidationErrors($keys): void
    {
        $errors = $this->json('errors.0.validation');
        PHPUnit::assertTrue(
            $this->json('errors.0.http_code') === 422,
            'Failed to find a validation http code in the response'
        );
        foreach (Arr::wrap($keys) as $key) {
            PHPUnit::assertTrue(
                isset($errors[$key]),
                "Failed to find a validation error in the response for key: '{$key}'"
            );
        }
    }

    /**
     * Verify that un authorized response has proper structure and status code
     */
    public function assertUnAuthorized(): void
    {
        PHPUnit::assertTrue(
            $this->json('errors.0.http_code') === 401,
            'Failed to find a validation http code in the response'
        );
    }

    public function assertPermissionDenied(): void
    {
        PHPUnit::assertTrue(
            $this->json('errors.0.http_code') === 403,
            'Failed to find a validation http code in the response'
        );
    }

    public function assertKeyIsString(string $key, bool $nullAble = false)
    {
        $value = $this->json($key);
        $isNull = is_null($value);
        if ($isNull && !$nullAble) {
            $isNull = false;
        }
        PHPUnit::assertTrue(is_string($value) || $isNull);
    }

    public function assertKeyIsInt(string $key, bool $nullAble = false)
    {
        $value = $this->json($key);
        $isNull = is_null($value);
        if ($isNull && !$nullAble) {
            $isNull = false;
        }
        PHPUnit::assertTrue(is_int($value) || $isNull);
    }

    public function assertKeyIsBool(string $key, bool $nullAble = false)
    {
        $value = $this->json($key);
        $isNull = is_null($value);
        if ($isNull && !$nullAble) {
            $isNull = false;
        }
        PHPUnit::assertTrue(is_bool($value) || $isNull);
    }

    public function assertKeysHaveTypes(string $key, array $attrsTypes)
    {
        foreach ($attrsTypes as $attribute => $type) {
            if ($type == 'int') {
                $this->assertKeyIsInt($key . '.' . $attribute);
            } elseif ($type == '?int') {
                $this->assertKeyIsInt($key . '.' . $attribute, true);
            } elseif ($type == 'string') {
                $this->assertKeyIsString($key . '.' . $attribute);
            } elseif ($type == '?string') {
                $this->assertKeyIsString($key . '.' . $attribute, true);
            } elseif ($type == 'bool') {
                $this->assertKeyIsBool($key . '.' . $attribute, true);
            }
        }
    }

    public function assertKeyHasValue(string $key, $value)
    {
        PHPUnit::assertTrue($value === $this->json($key));
    }
}