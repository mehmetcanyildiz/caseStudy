<?php

namespace App\Services\TodoService\DTO;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;

/**
 * Abstract Data Transfer Object (DTO)
 */
abstract class AbstractDTO
{
    /**
     * Transform Data Transfer Object to an array.
     *
     * @param string[] $only   Properties to include in the array
     * @param string[] $except Properties to exclude from the array
     *
     * @return array<string, mixed>
     */
    public function toArray(array $only = [], array $except = []): array
    {
        $properties = (new ReflectionClass($this))->getProperties();
        $result     = [];

        foreach ($properties as $property) {
            $propertyName = $property->getName();

            if ($this->shouldSkipProperty($propertyName, $only, $except)) {
                continue;
            }

            $value = $this->getPropertyValue($property);

            $result[$propertyName] = $this->transformValue($value);
        }

        return $result;
    }

    /**
     * Transform Data Transfer Object to a model array.
     *
     * @param string[] $only   Properties to include in the array
     * @param string[] $except Properties to exclude from the array
     *
     * @return array<string, mixed>
     */
    public function toModelArray(array $only = [], array $except = []): array
    {
        $array      = $this->toArray($only, $except);
        $modelArray = [];

        foreach ($array as $key => $value) {
            $modelArray[Str::snake($key)] = $value;
        }

        return $modelArray;
    }

    /**
     * Check if a property should be skipped during transformation.
     *
     * @param string   $propertyName Property name
     * @param string[] $only         Properties to include
     * @param string[] $except       Properties to exclude
     *
     * @return bool Whether to skip the property
     */
    private function shouldSkipProperty(string $propertyName, array $only, array $except): bool
    {
        return (count($only) > 0 && !in_array($propertyName, $only)) ||
               (count($except) > 0 && in_array($propertyName, $except));
    }

    /**
     * Get the value of a property from the Data Transfer Object.
     *
     * @param \ReflectionProperty $property ReflectionProperty instance
     *
     * @return mixed The value of the property
     */
    private function getPropertyValue(\ReflectionProperty $property): mixed
    {
        $value = $property->getValue($this);

        return ($value instanceof AbstractDTO || $value instanceof Collection)
            ? $value->toArray()
            : $value;
    }

    /**
     * Transform the value before adding it to the result array.
     *
     * @param mixed $value Property value
     *
     * @return mixed Transformed value
     */
    private function transformValue($value): mixed
    {
        return is_array($value) ? new Collection($value) : $value;
    }
}
