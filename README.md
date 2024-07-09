# LaravelEnumInjection
DocBlockを利用してEnumオブジェクトの値に複数の値を持たせられます。
通常だとそれぞれreturn match文で処理していたメソッドを、簡単に纏められます。

## How To Use
caseの定義のdocblockに@v_{メソッド名}で定義。
use文を使って読み込ませ、docBlockParseメソッドを返却するだけで@v_{メソッド名}を返却出来ます。

```StructureInt.php
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
     * @throws \ReflectionException
     */
    public function name(): string
    {
        return $this->docBlockParse();
    }

    /**
     * @throws \ReflectionException
     */
    public function slug(): string
    {
        return $this->docBlockParse();
    }
}
```

「v_」の部分を変更したい場合は以下をオーバーライドしてください。

```php
protected function getNamePrefix(string $name): string
```

EnumValidateRuleを利用すると、以下のメソッドが生えLaravelのEnumValidationが取得出来ます。
```php
StructureInt::rules();
StructureInt::ruleExpect(array $expect = []);
StructureInt::ruleOnly(array $only = []);
```