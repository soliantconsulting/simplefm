<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Repository\Builder\Metadata;

use Assert\Assertion;

final class OneToOne
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var string
     */
    private $propertyName;

    /**
     * @var string
     */
    private $targetEntity;

    /**
     * @var bool
     */
    private $isOwningSide;

    /**
     * @var string
     */
    private $joinFieldName;

    public function __construct(
        string $fieldName,
        string $propertyName,
        string $targetEntity,
        bool $isOwningSide,
        string $joinFieldName = null
    ) {
        if ($isOwningSide) {
            Assertion::notNull($joinFieldName);
        }

        $this->fieldName = $fieldName;
        $this->propertyName = $propertyName;
        $this->targetEntity = $targetEntity;
        $this->isOwningSide = $isOwningSide;
        $this->joinFieldName = $isOwningSide ? $joinFieldName : null;
    }

    public function getFieldName() : string
    {
        return $this->fieldName;
    }

    public function getPropertyName() : string
    {
        return $this->propertyName;
    }

    public function getTargetEntity() : string
    {
        return $this->targetEntity;
    }

    public function isOwningSide() : bool
    {
        return $this->isOwningSide;
    }

    public function getJoinFieldName() : string
    {
        Assertion::notNull($this->joinFieldName);
        return $this->joinFieldName;
    }
}
