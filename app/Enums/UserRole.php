<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Our = 'our';
    case Adviser = 'adviser';
    case Student = 'student';
    case Evaluator = 'evaluator';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrator',
            self::Our => 'OUR Staff',
            self::Adviser => 'Adviser',
            self::Student => 'Student',
            self::Evaluator => 'Evaluator',
        };
    }

    public function routePrefix(): string
    {
        return $this->value;
    }

    public function dashboardRoute(): string
    {
        return "{$this->routePrefix()}.dashboard";
    }

    /** @return list<UserRole> */
    public static function all(): array
    {
        return self::cases();
    }
}
