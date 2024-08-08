<?php

namespace App\Helpers;

use ReflectionClass;

abstract class Enum {

    static function getKeys() : array {
        $class = new ReflectionClass(get_called_class());
        return array_keys($class->getConstants());
    }
    static function getValues() : array {
        $class = new ReflectionClass(get_called_class());
        return array_values($class->getConstants());
    }

    static function getMap(): array {
        $class = new ReflectionClass(get_called_class());
        return $class->getConstants();
    }
}

