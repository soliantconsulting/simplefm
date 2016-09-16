<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Connection;

use Http\Client\HttpClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use SimpleXMLElement;
use Zend\Diactoros\Request;
use Zend\Diactoros\Stream;

final class Connection implements ConnectionInterface
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var UriInterface
     */
    private $uri;

    /**
     * @var string
     */
    private $database;

    public function __construct(HttpClient $httpClient, UriInterface $uri, string $database)
    {
        $this->httpClient = $httpClient;
        $this->uri = $uri;
        $this->database = $database;
    }

    public function execute(Command $command, string $grammarPath) : SimpleXMLElement
    {
        $uri = $this->uri->withPath($grammarPath);
        $response = $this->httpClient->sendRequest($this->buildRequest($command, $uri));

        $previousValue = libxml_use_internal_errors(true);
        $xml = simplexml_load_string($response->getBody());
        libxml_use_internal_errors($previousValue);

        if (false === $xml) {
            throw Exception\InvalidResponse::fromXmlError(libxml_get_last_error());
        }

        return $xml;
    }

    private function buildRequest(Command $command, UriInterface $uri) : RequestInterface
    {
        $body = new Stream('php://temp', 'wb+');
        $body->write(sprintf('-db=%s&%s', urlencode($this->database), $command));
        $body->rewind();

        return (new Request($uri, 'POST'))
            ->withAddedHeader('Content-type', 'application/x-www-form-urlencoded')
            ->withBody($body);
    }
}
