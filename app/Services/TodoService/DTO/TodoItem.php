<?php

namespace App\Services\TodoService\DTO;

use App\Enums\TodoProviders;

/**
 * To do Items DTO
 */
class TodoItem extends AbstractDTO
{
    /**
     * @param TodoProviders $provider
     * @param ?int          $points
     * @param ?int          $estimatedDuration
     * @param string        $name
     */
    public function __construct(
        public TodoProviders $provider,
        public string $name,
        public ?int $points = null,
        public ?int $estimatedDuration = null,
    ) {
    }
}
