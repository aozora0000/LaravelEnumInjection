<?php

namespace LaravelEnumInjection;

use Illuminate\Validation\Rules\Enum;

trait EnumValidateRule
{
    public static function rules(): Enum
    {
        return new Enum(self::class);
    }

    public static function ruleExpect(array $except = []): Enum
    {
        return static::rules()->except($except);
    }

    public static function ruleOnly(array $except = []): Enum
    {
        return static::rules()->except($except);
    }
}