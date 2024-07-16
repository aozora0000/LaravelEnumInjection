<?php

namespace LaravelEnumInjection;

use BackedEnum;
use phpDocumentor\Reflection\DocBlockFactory;
use ReflectionEnum;
use ReflectionException;

trait DocBlockParser
{
    protected function getNamePrefix(string $name): string
    {
        return 'v_' . $name;
    }

    /**
     * @throws ReflectionException
     */
    public function __call(string $name, array $arguments)
    {
        return $this->docBlockParse($name);
    }

    /**
     * @throws ReflectionException
     */
    private function docBlockParse(string $name = ''): string
    {
        \assert($this instanceof BackedEnum);
        if($name === '') {
            $name = debug_backtrace()[1]['function'];
        }
        $name = $this->getNamePrefix($name);
        $factory = DocBlockFactory::createInstance();
        $rc = new ReflectionEnum($this);
        $docBlock = $factory->create($rc->getCase($this->name)->getDocComment());
        if ($docBlock->hasTag($name) && \is_array($docBlock->getTagsByName($name))) {
            return $docBlock->getTagsByName($name)[0]->render(new EmptyFormatter());
        }

        return '';
    }
}