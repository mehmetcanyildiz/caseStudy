<?php

namespace App\Services\TodoService;

use App\Enums\TodoProviders;
use App\Services\TodoService\Adapters\Provider1;
use App\Services\TodoService\Adapters\Provider2;

/**
 * TodoService Manager
 */
class TodoServiceManager implements TodoServiceManagerInterface
{
    /**
     * @param string $todoProvider
     *
     * @return TodoServiceAdapterInterface
     */
    public static function getTodoServiceAdapter(string $todoProvider): TodoServiceAdapterInterface
    {
        $provider = TodoProviders::tryFrom($todoProvider);

        return self::loadTodoService($provider);
    }

    /**
     * @param TodoProviders $todoProvider
     *
     * @return TodoServiceAdapterInterface
     */
    public static function loadTodoService(TodoProviders $todoProvider): TodoServiceAdapterInterface
    {
        return resolve(
            match ($todoProvider) {
                TodoProviders::PROVIDER1 => Provider1::class,
                TodoProviders::PROVIDER2 => Provider2::class,
            }
        );
    }
}
