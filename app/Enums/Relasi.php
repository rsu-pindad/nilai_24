<?php

namespace App\Enums;

enum Relasi: string
{
    case SELF    = 'self';
    case STAFF   = 'staff';
    case REKANAN = 'rekanan';
    case ATASAN  = 'atasan';

    public function labels(): string
    {
        return match ($this) {
            self::SELF    => 'SELF',
            self::STAFF   => 'STAFF',
            self::REKANAN => 'REKANAN',
            self::ATASAN  => 'ATASAN',
        };
    }

    public function labelPowergridFilter(): string
    {
        return $this->labels();
    }
}
