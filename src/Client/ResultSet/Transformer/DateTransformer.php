<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Client\Transformer;

use DateTimeImmutable;
use DateTimeZone;

final class DateTransformer
{
    /**
     * @var DateTimeZone
     */
    private static $utcTimeZone;

    public function __invoke(string $value) : DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat(
            '!m/d/Y',
            $value,
            self::$utcTimeZone ?: (self::$utcTimeZone = new DateTimeZone('UTC'))
        );
    }
}
