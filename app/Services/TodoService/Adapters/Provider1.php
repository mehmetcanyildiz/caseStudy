<?php

namespace App\Services\TodoService\Adapters;

use App\Enums\TodoProviders;
use App\Services\TodoService\DTO\TodoItem;
use App\Services\TodoService\DTO\Todos;
use App\Services\TodoService\TodoServiceAdapter;
use App\Services\TodoService\TodoServiceAdapterInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Provider 1
 */
class Provider1 extends TodoServiceAdapter implements TodoServiceAdapterInterface
{
    protected string $endpoint = 'https://run.mocky.io/v3/27b47d79-f382-4dee-b4fe-a0976ceda9cd';

    /**
     * Get endpoint
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Get Todos
     * @return Todos|null
     * @throws GuzzleException
     */
    public function getTodos(): ?Todos
    {
        $todos     = $this->getConnectTodos();
        $todoItems = Todos::builder();
        foreach ($todos as $todo) {
            $todoItems->setItems(
                new TodoItem(
                    provider: TodoProviders::PROVIDER1,
                    name: $todo['id'],
                    points: $todo['zorluk'] ?? '',
                    estimatedDuration:  $todo['sure'] ?? '',
                )
            );
        }

        return $todoItems;
    }
}
