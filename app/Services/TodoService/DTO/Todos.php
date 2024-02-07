<?php

namespace App\Services\TodoService\DTO;

use App\Models\Todo;
use Illuminate\Support\Collection;

/**
 * Todos DTO
 */
class Todos
{
    private ?array $items;

    /**
     * Builder
     * @return static
     */
    public static function builder(): static
    {
        return new static();
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return collect($this->items);
    }

    /**
     * @param TodoItem|Todo|null $item
     *
     * @return $this
     */
    public function setItems(TodoItem|Todo|null $item): Todos
    {
        $this->items[] = $item;

        return $this;
    }
}
