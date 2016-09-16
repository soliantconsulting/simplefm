<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Repository;

interface HydrationInterface
{
    public function hydrate(array $data, $object = null);
}
