<?php

namespace App\Services\TodoService;

/**
 * TodoService Manager Interface
 */
interface TodoServiceManagerInterface
{
    /**
     * @param string $todoProvider
     *
     * @return TodoServiceAdapterInterface
     */
    public static function getTodoServiceAdapter(string $todoProvider): TodoServiceAdapterInterface;
}
