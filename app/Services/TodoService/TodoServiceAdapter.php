<?php

namespace App\Services\TodoService;

use App\Services\TodoService\DTO\Todos;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * TodoService Adapter
 */
abstract class TodoServiceAdapter
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    protected function getConnectTodos(): array
    {
        $response = $this->client->request('GET', $this->getEndpoint());

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return string
     */
    abstract protected function getEndpoint(): string;

    /**
     * @return Todos|null
     */
    abstract public function getTodos(): ?Todos;
}
