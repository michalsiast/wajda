<?php

namespace App\Models;

use App\Helpers\Enum;
use ReflectionClass;

abstract class FieldType extends Enum
{
    const HEAD = 'head';
    const TEXT = 'text';
    const ROTATOR = 'rotator';
}
