<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Client\Transformer;

use DateTimeImmutable;
use DateTimeZone;

final class TimeTransformer
{
    /**
     * @var DateTimeZone
     */
    private static $utcTimeZone;

    public function __invoke(string $value) : DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat(
            '!H:i:s',
            $value,
            self::$utcTimeZone ?: (self::$utcTimeZone = new DateTimeZone('UTC'))
        );
    }
}
