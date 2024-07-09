<?php

namespace LaravelEnumInjection;

use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;

class EmptyFormatter implements Formatter
{
    public function format(Tag $tag): string
    {
        return trim($tag);
    }
}