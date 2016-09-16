<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Connection;

use DateTimeInterface;

final class Command
{
    /**
     * @var array
     */
    private $parameters;

    public function __construct(string $layout, array $parameters)
    {
        if (array_key_exists($parameters, '-db')) {
            // @todo throw exception
        }

        if (array_key_exists($parameters, '-lay')) {
            // @todo throw exception
        }

        foreach ($parameters as $value) {
            if (!$value instanceof DateTimeInterface && !is_scalar($value)) {
                // @todo throw exception
            }
        }

        $this->parameters = ['-lay' => $layout] + $parameters;
    }

    public function getLayout() : string
    {
        return $this->parameters['-lay'];
    }

    public function __toString() : string
    {
        $parts = [];

        foreach ($this->parameters as $name => $value) {
            if ($value instanceof DateTimeInterface) {
                $value = $value->format('m/d/Y H:i:s');
            }

            if (null === $value || '' === $value) {
                $parts[] = urlencode($name);
                continue;
            }

            $parts[] = sprintf('%s=%s', urlencode($name), urlencode($value));
        }

        return implode('&', $parts);
    }
}
