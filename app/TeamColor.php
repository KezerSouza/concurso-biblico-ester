<?php

namespace App;

enum TeamColor: string
{
    case Blue = 'blue';
    case Yellow = 'yellow';
    case Red = 'red';

    public function label(): string
    {
        return match ($this) {
            self::Blue => 'Equipe Azul',
            self::Yellow => 'Equipe Amarela',
            self::Red => 'Equipe Vermelha',
        };
    }

    public function bootstrapColor(): string
    {
        return match ($this) {
            self::Blue => 'blue',
            self::Yellow => 'warning',
            self::Red => 'danger',
        };
    }
}
