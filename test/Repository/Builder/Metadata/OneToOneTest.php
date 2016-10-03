<?php
declare(strict_types = 1);

namespace SoliantTest\SimpleFM\Repository\Builder\Metadata;

use Assert\InvalidArgumentException;
use PHPUnit_Framework_TestCase as TestCase;
use Soliant\SimpleFM\Repository\Builder\Metadata\OneToOne;

final class OneToOneTest extends TestCase
{
    public function testGenericGetters()
    {
        $metadata = new OneToOne('fieldName', 'propertyName', 'targetEntity', true, 'joinFieldName');
        $this->assertSame('fieldName', $metadata->getFieldName());
        $this->assertSame('propertyName', $metadata->getPropertyName());
        $this->assertSame('targetEntity', $metadata->getTargetEntity());
        $this->assertSame('joinFieldName', $metadata->getJoinFieldName());
    }

    public function testExceptionOnMissingJoinFieldName()
    {
        $this->expectException(InvalidArgumentException::class);
        new OneToOne('fieldName', 'propertyName', 'targetEntity', true);
    }

    public function testJoinFieldNameIsSetToNullOnInverseSide()
    {
        $metadata = new OneToOne('fieldName', 'propertyName', 'targetEntity', false, 'foo');

        $this->expectException(InvalidArgumentException::class);
        $metadata->getJoinFieldName();
    }
}
