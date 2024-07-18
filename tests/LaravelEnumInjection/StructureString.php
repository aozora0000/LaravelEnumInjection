<?php

namespace Tests\LaravelEnumInjection;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use LaravelEnumInjection\CaseAttributeValues;
use LaravelEnumInjection\EnumValidateRule;
use LaravelEnumInjection\InjectionValues;

enum StructureString: string implements Arrayable, Jsonable, JsonSerializable
{
    use CaseAttributeValues;
    use EnumValidateRule;

    #[InjectionValues(id: 'one', name: 'One', slug: 'structure-1')]
    case one = 'one';

    #[InjectionValues(id: 'two', name: 'Two', slug: "structure-2")]
    case two = 'two';

    #[InjectionValues(id: 'three', name: 'Three')]
    case three = 'three';
}