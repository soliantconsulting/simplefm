<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Client\ResultSet\Transformer;

use InvalidArgumentException;
use Litipk\BigNumbers\Decimal;
use Soliant\SimpleFM\Client\ResultSet\Exception\ParseException;

final class NumberTransformer
{
    public function __invoke(string $value)
    {
        if ('' === $value) {
            return null;
        }

        if (0 === strpos($value, '.')) {
            $value = '0' . $value;
        }

        /**
         * \Litipk\Exceptions\InvalidArgumentTypeException is a subclass of \InvalidArgumentException, but for some
         * reason, they can throw both. So we're catching the superclass, and rethrowing a ParseException with more
         * useful information about the problem.
         */
        try {
            $return = Decimal::fromString($value);
        } catch (InvalidArgumentException $e) {
            throw new ParseException(
                '"' . $value . '" must be a string that represents uniquely a float point number.'
            );
        }
        return $return;
    }
}
