<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Repository\Builder\Type;

use Assert\Assertion;
use Litipk\BigNumbers\Decimal;

final class IntegerType implements TypeInterface
{
    public function fromFileMakerValue($value)
    {
        Assertion::isInstanceOf(Decimal::class);
        return $value->asInteger();
    }

    public function toFileMakerValue($value)
    {
        Assertion::integer($value);
        return $value;
    }
}
