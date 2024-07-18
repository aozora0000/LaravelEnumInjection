<?php

namespace Tests\LaravelEnumInjection;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use LaravelEnumInjection\CaseAttributeValues;
use LaravelEnumInjection\EnumValidateRule;
use LaravelEnumInjection\InjectionValues;

enum StructureInt: int implements Arrayable, Jsonable, JsonSerializable
{
    use CaseAttributeValues;
    use EnumValidateRule;

    #[InjectionValues(id: 1, name: 'One', slug: "structure-1")]
    case one = 1;

    #[InjectionValues(id: 2, name: 'Two', slug: "structure-2")]
    case two = 2;

    #[InjectionValues(id: 3, name: 'Three')]
    case three = 3;
}
