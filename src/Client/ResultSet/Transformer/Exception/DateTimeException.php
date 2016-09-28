<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Client\ResultSet\Transformer\Exception;

use DomainException;

final class DateTimeException extends DomainException implements ExceptionInterface
{
    public static function fromDateTimeError(string $value, array $lastErrors) : self
    {
        $message = isset($lastErrors['errors'][0]) ? $lastErrors['errors'][0] : 'Unexpected data found.';
        return new self(sprintf('Could not parse "%s", reason: %s', $value, $message));
    }
}
