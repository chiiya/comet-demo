<?php

namespace App\Contracts;

interface HasRelations
{
    public static function getRelationNames(): array;
}

