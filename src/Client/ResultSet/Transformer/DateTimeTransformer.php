<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Client\Transformer;

use DateTimeImmutable;
use DateTimeZone;

final class DateTimeTransformer
{
    /**
     * @var DateTimeZone
     */
    private $timeZone;

    public function __construct(DateTimeZone $timeZone)
    {
        $this->timeZone = $timeZone;
    }

    public function __invoke(string $value) : DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat('!m/d/Y H:i:s', $value, $this->timeZone);
    }
}
