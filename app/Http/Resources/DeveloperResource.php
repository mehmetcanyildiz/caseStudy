<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Developer Resource
 */
class DeveloperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->resource->id,
            'name'              => $this->resource->name,
            'level'             => $this->resource->level,
            'total_assign_hour' => $this->resource->total_assign_hour,
            'total_week'        => number_format($this->resource->total_week, 2),
            'todos'             => TodoResource::collection($this->resource->todos),
        ];
    }
}
