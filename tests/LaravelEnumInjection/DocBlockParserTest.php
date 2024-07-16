<?php

namespace Tests\LaravelEnumInjection;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DocBlockParserTest extends TestCase
{
    #[Test]
    public function Int列挙型のDocBlockから値が取得出来る(): void
    {
        $enum = StructureInt::one;
        $this->assertSame('One', $enum->name());
        $this->assertSame('structure-1', $enum->slug());
        $this->assertSame([
            'id' => 1,
            'name' => 'One',
            'slug' => 'structure-1',
        ], $enum->toArray());
    }

    #[Test]
    public function Int列挙型のDocBlockで定義されていない値は空になる(): void
    {
        $enum = StructureInt::three;
        $this->assertSame('Three', $enum->name());
        $this->assertSame('', $enum->slug());
    }

    #[Test]
    public function Int列挙型のDocBlockからValidationRuleが取得出来る(): void
    {
        $this->assertTrue(StructureInt::ruleOnly([1])->passes('', 1));
        $this->assertFalse(StructureInt::rules()->passes('', 'One'));
    }

    #[Test]
    public function String列挙型のDocBlockから値が取得出来る(): void
    {
        $enum = StructureString::one;
        $this->assertSame('One', $enum->name());
        $this->assertSame('structure-1', $enum->slug());
        $this->assertSame([
            'id' => 'one',
            'name' => 'One',
            'slug' => 'structure-1',
        ], $enum->toArray());
    }

    #[Test]
    public function String列挙型のDocBlockで定義されていない値は空になる(): void
    {
        $enum = StructureString::three;
        $this->assertSame('Three', $enum->name());
        $this->assertSame('', $enum->slug());
    }

    #[Test]
    public function String列挙型のDocBlockからValidationRuleが取得出来る(): void
    {
        $this->assertTrue(StructureString::ruleOnly(['one'])->passes('', 'one'));
        $this->assertFalse(StructureString::rules()->passes('', 'One'));
    }

}