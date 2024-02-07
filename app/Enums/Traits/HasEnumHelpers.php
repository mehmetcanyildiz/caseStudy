<?php

namespace App\Enums\Traits;

/**
 * Has Enum Helpers
 */
trait HasEnumHelpers
{
    /**
     * @return array<int, string>
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return array<int, int|string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function random(): self
    {
        return constant(sprintf('self::%s', self::names()[array_rand(self::names())]));
    }

    public static function getTryFrom(?string $value): ?static
    {
        if (empty($value)) {
            return null;
        }

        return self::tryFrom($value) ?? null;
    }
}
