<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Arr;

enum EmployeeStatusEnum: string
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case BLOCKED = 'BLOCKED';

    public static function fromId(int $id): ?EmployeeStatusEnum
    {
        return Arr::first(self::cases(), static fn(self $enum) => $enum->id() === $id);
    }

    public function id(): int
    {
        return match ($this) {
            self::ACTIVE => 1,
            self::INACTIVE => 2,
            self::BLOCKED => 3
        };
    }
}
