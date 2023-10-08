<?php

declare(strict_types=1);

namespace App\Enums;

enum ProjectStatusEnum: string
{
    case ABANDONED = "abandoned";
    case INACTIVE = "inactive";
    case DEPRECATED = "deprecated";

    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            ProjectStatusEnum::ABANDONED => 'Abandonado',
            ProjectStatusEnum::INACTIVE => 'Inativo',
            ProjectStatusEnum::DEPRECATED => 'Descontinuado',
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
