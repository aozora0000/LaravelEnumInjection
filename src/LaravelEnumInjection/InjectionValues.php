<?php

namespace LaravelEnumInjection;


use Illuminate\Support\Collection;

#[\Attribute] class InjectionValues
{
    /**
     * @var Collection<string, string|integer>
     */
    private Collection $inputs;

    public function __construct(array ...$inputs)
    {
        $this->inputs = collect($inputs);
    }

    public function has(string $name): bool
    {
        return $this->inputs->has($name);
    }

    /**
     * @template T
     * @param string $name
     * @return T
     */
    public function get(string $name)
    {
        return $this->inputs->get($name);
    }
}