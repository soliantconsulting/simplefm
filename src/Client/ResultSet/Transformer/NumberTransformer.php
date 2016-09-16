<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Client\Transformer;

use Litipk\BigNumbers\Decimal;

final class NumberTransformer
{
    public function __invoke(string $value) : Decimal
    {
        return Decimal::fromString($value);
    }
}
