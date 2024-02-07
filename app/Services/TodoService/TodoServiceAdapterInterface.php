<?php

namespace App\Services\TodoService;

use App\Services\TodoService\DTO\Todos;

/**
 * TodoService Adapter Interface
 */
interface TodoServiceAdapterInterface
{
    /**
     * @return Todos|null
     */
    public function getTodos(): ?Todos;
}
