<?php

namespace LaravelEnumInjection;

use BackedEnum;
use LaravelEnumInjection\Exception\UndefinedPropertyException;
use LaravelEnumInjection\Exception\UnsetAttributeException;
use ReflectionAttribute;
use ReflectionEnum;
use ReflectionException;

trait CaseAttributeValues
{
    /**
     * @throws ReflectionException
     */
    public function __call(string $name, array $arguments)
    {
        return $this->getCaseAttribute($name);
    }

    /**
     * @throws ReflectionException
     * @throws UnsetAttributeException
     */
    private function getCaseAttributes(): array
    {
        \assert($this instanceof BackedEnum);
        $rc = new ReflectionEnum($this);
        $case = $rc->getCase($this->name);
        $attrs = $case->getAttributes(InjectionValues::class, ReflectionAttribute::IS_INSTANCEOF);
        if(empty($attrs)) {
            throw new UnsetAttributeException(sprintf("%s::%sにアトリビュートが指定されていません", get_class($this), $this->name));
        }
        return $attrs[0]->getArguments();
    }

    /**
     * @throws ReflectionException
     * @throws UndefinedPropertyException
     */
    private function getCaseAttribute(string $name = ''): string
    {
        if($name === '') {
            $name = debug_backtrace()[1]['function'];
        }
        $items = collect($this->getCaseAttributes($name));
        if($items->has($name)) {
            return $items->get($name);
        }
        throw new UndefinedPropertyException(sprintf("%s::%sのアトリビュートに%sが設定されていません。", get_class($this), $this->name, $name));
    }
}