<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestResponse;

abstract class GraphQLTestCase extends TestCase
{
    /**
     * @var string
     */
    protected $appUrl;
    /**
     * @var string
     */
    protected $operationsList;

    public function setUp()
    {
        parent::setUp();
        $this->appUrl = config('app.url') . '/' . config('graphiql.routes.graphql');
        $this->operationsList = file_get_contents(config_path('operations-list.graphql'));
    }

    public function actingAsDefaultUser()
    {
        $this->actingAs(User::find(1));
    }

    /**
     * @param string $operationName
     * @param array $queryData
     * @param array $responseFields list of field to get back as response
     * @param array $headers
     * @return TestResponse
     */
    public function graphqlQuery(string $operationName, array $queryData = [], array $responseFields = [], $headers = []): TestResponse
    {
        $data['query'] = $this->extractOperationFromOperationsList($operationName);
        $data['query'] = $this->specifyQueryData($data['query'], $queryData);
        $data['query'] = $this->specifyResponseFields($data['query'], $responseFields);

        return parent::post($this->appUrl, $data, $headers);
    }

    /**
     * @param string $operationName
     * @param array $postData
     * @param array $responseFields list of field to get back as response
     * @param array $headers
     * @return TestResponse
     */
    public function graphqlMutation(string $operationName, array $postData = [], array $responseFields = [], $headers = []): TestResponse
    {
        $data['query'] = $this->extractOperationFromOperationsList($operationName, 'mutation');
        $data['query'] = $this->specifyQueryData($data['query'], $postData);
        $data['query'] = $this->specifyResponseFields($data['query'], $responseFields);

        return parent::post($this->appUrl, $data, $headers);
    }

    /**
     * @param string $operationName
     * @param string $operationType
     * @return string
     * @throws \Exception
     */
    protected function extractOperationFromOperationsList(string $operationName, string $operationType = 'query')
    {
        $position = strpos($this->operationsList, $operationName);
        $subString = substr($this->operationsList, $position);
        $extractedOperation = $this->getStringBetweenBrackets($subString);
        if ($extractedOperation === false) {
            throw new \Exception('Operation not found in operation list');
        }

        return trim($operationType . ' ' . $extractedOperation);
    }

    /**
     * @param string $graphQLOperation
     * @param array $fields
     * @return string
     */
    protected function specifyResponseFields(string $graphQLOperation, array $fields): string
    {
        if (empty($fields)) {
            return $graphQLOperation;
        }

        $stringToReplace = substr($graphQLOperation, $this->getSecondOccurrencePosition($graphQLOperation));

        $graphQLOperation = str_replace(
            $stringToReplace,
            "{\n" . implode("\n", $fields) . "\n}}",
            $graphQLOperation
        );

        return $graphQLOperation;
    }

    /**
     * @param string $graphQLOperation
     * @param array $data
     * @return string
     */
    protected function specifyQueryData(string $graphQLOperation, array $data): string
    {
        if (empty($data)) {
            return $graphQLOperation;
        }

        $postDataString = '';
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = '"' . $value . '"';
            }

            $postDataString .= "{$key}: {$value}, ";
        }

        $postDataString = rtrim($postDataString, ', ');

        if (preg_match('/\(.*\)/', $graphQLOperation)) {
            $graphQLOperation = preg_replace('/\(.*\)/', "({$postDataString})", $graphQLOperation);
        } else {
            $position = $this->getSecondOccurrencePosition($graphQLOperation);
            $subString = substr($graphQLOperation, $position);
            $graphQLOperation = str_replace($subString, "({$postDataString}) $subString", $graphQLOperation);
        }

        return $graphQLOperation;
    }

    /**
     * Returns text between '{' and '}'
     * @param string $subject
     * @return bool
     */
    private function getStringBetweenBrackets(string $subject)
    {
        preg_match('/("|\').*?\1(*SKIP)(*FAIL)|\{(?:[^{}]|(?R))*\}/', $subject, $extractedOperation);
        return $extractedOperation[0] ?? false;
    }

    /**
     * @param string $subject
     * @param string $needle
     * @return int
     */
    private function getSecondOccurrencePosition(string $subject, string $needle = '{'): int
    {
        $pos1 = strpos($subject, $needle);
        $pos2 = strpos($subject, $needle, $pos1 + strlen($needle));
        return $pos2;
    }
}
