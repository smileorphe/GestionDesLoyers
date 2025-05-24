<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case USER = 'user';

    /**
     * Vérifie si une valeur donnée est un rôle valide
     */
    public static function isValid(string $role): bool
    {
        return in_array($role, [
            self::ADMIN->value,
            self::USER->value
        ]);
    }
}
