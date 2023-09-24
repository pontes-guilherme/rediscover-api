<?php

declare(strict_types=1);

namespace App\Enums;

enum UserTypesEnum: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            UserTypesEnum::ADMIN => 'Administrador',
            UserTypesEnum::CLIENT => 'Cliente',
        };
    }

    public static function toArray(): array
    {
        return collect(self::cases())
            ->map(fn($case) => [
                'value' => $case->value,
                'label' => self::getLabel($case),
            ])->toArray();
    }
}
