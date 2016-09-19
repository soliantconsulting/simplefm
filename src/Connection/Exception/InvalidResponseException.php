<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Connection\Exception;

use LibXMLError;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

final class InvalidResponseException extends RuntimeException implements ExceptionInterface
{
    public static function fromUnsuccessfulResponse(ResponseInterface $response) : self
    {
        return new self(sprintf(
            'The FileMaker server responded with an unexpected error code: %d %s',
            $response->getStatusCode(),
            $response->getReasonPhrase()
        ), $response->getStatusCode());
    }

    public static function fromXmlError(LibXMLError $error) : self
    {
        return new self(sprintf('An unexpected XML error occured: %s', $error->message));
    }
}
