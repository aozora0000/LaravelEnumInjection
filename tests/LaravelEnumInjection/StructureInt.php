<?php

namespace Tests\LaravelEnumInjection;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use LaravelEnumInjection\DocBlockParser;
use LaravelEnumInjection\EnumValidateRule;

enum StructureInt: int implements Arrayable, Jsonable, JsonSerializable
{
    use DocBlockParser;
    use EnumValidateRule;

    /**
     * @v_name One
     * @v_slug structure-1
     */
    case one = 1;

    /**
     * @v_name Two
     * @v_slug structure-2
     */
    case two = 2;

    /**
     * @v_name Three
     */
    case three = 3;

    /**
     * @throws \ReflectionException
     */
    public function toArray()
    {
        return [
            'id' => $this->value,
            'name' => $this->name(),
            'slug' => $this->slug(),
        ];
    }

    public function toJson($options = 0)
    {
        return $this->toArray();
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
