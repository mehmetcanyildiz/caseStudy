<?php

namespace App\Services\TodoService\Adapters;

use App\Enums\TodoProviders;
use App\Services\TodoService\DTO\TodoItem;
use App\Services\TodoService\DTO\Todos;
use App\Services\TodoService\TodoServiceAdapter;
use App\Services\TodoService\TodoServiceAdapterInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Provider 2
 */
class Provider2 extends TodoServiceAdapter implements TodoServiceAdapterInterface
{
    protected string $endpoint = 'https://run.mocky.io/v3/7b0ff222-7a9c-4c54-9396-0df58e289143';

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
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
                    provider: TodoProviders::PROVIDER2,
                    name: $todo['id'],
                    points: $todo['value'] ?? '',
                    estimatedDuration: $todo['estimated_duration'] ?? '',
                )
            );
        }

        return $todoItems;
    }
}
