<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Repository\Builder;

use Assert\Assertion;
use Exception;
use ReflectionClass;
use Soliant\SimpleFM\Repository\Builder\Exception\ExtractionException;
use Soliant\SimpleFM\Repository\Builder\Metadata\Entity;
use Soliant\SimpleFM\Repository\Builder\Metadata\ManyToOne;
use Soliant\SimpleFM\Repository\Builder\Metadata\OneToOne;
use Soliant\SimpleFM\Repository\ExtractionInterface;

final class MetadataExtraction implements ExtractionInterface
{
    /**
     * @var Entity
     */
    private $entityMetadata;

    public function __construct(Entity $entityMetadata)
    {
        $this->entityMetadata = $entityMetadata;
    }

    public function extract($entity) : array
    {
        return $this->extractWithMetadata($entity, $this->entityMetadata);
    }

    private function extractWithMetadata($entity, Entity $metadata) : array
    {
        Assertion::isInstanceOf($entity, $metadata->getClassName());

        $data = [];
        $reflectionClass = new ReflectionClass($entity);

        foreach ($metadata->getFields() as $fieldMetadata) {
            if ($fieldMetadata->isReadOnly()) {
                continue;
            }

            try {
                $type = $fieldMetadata->getType();
                $value = $this->getProperty(
                    $reflectionClass,
                    $entity,
                    $fieldMetadata->getPropertyName()
                );

                if (!$fieldMetadata->isRepeatable()) {
                    $data[$fieldMetadata->getFieldName()] = $type->toFileMakerValue($value);
                    continue;
                }

                Assertion::isArray($value);
                $data[$fieldMetadata->getFieldName()] = array_map(function ($value) use ($type) {
                    return $type->toFileMakerValue($value);
                }, $value);
            } catch (Exception $e) {
                throw ExtractionException::fromInvalidField($metadata, $fieldMetadata, $e);
            }
        }

        foreach ($metadata->getEmbeddables() as $embeddableMetadata) {
            $prefix = $embeddableMetadata->getFieldNamePrefix();
            $embeddableData = $this->extractWithMetadata(
                $this->getProperty($reflectionClass, $entity, $embeddableMetadata->getPropertyName()),
                $embeddableMetadata->getMetadata()
            );

            foreach ($embeddableData as $key => $value) {
                $data[$prefix . $key] = $value;
            }
        }

        $toOne = array_filter(
            $metadata->getManyToOne(),
            function (ManyToOne $manyToOneMetadata) {
                return !$manyToOneMetadata->isReadOnly();
            }
        ) + array_filter(
            $metadata->getOneToOne(),
            function (OneToOne $oneToOneMetadata) {
                return $oneToOneMetadata->isOwningSide() && !$oneToOneMetadata->isReadOnly();
            }
        );

        foreach ($toOne as $relationMetadata) {
            $relation = $this->getProperty(
                $reflectionClass,
                $entity,
                $relationMetadata->getPropertyName()
            );

            if (null === $relation) {
                $data[$relationMetadata->getFieldName()] = null;
                continue;
            }

            Assertion::isInstanceOf($relation, $relationMetadata->getTargetEntity());

            $data[$relationMetadata->getFieldName()] = $this->getProperty(
                new ReflectionClass($relation),
                $relation,
                $relationMetadata->getTargetPropertyName()
            );
        }

        return $data;
    }

    private function getProperty(ReflectionClass $reflectionClass, $entity, string $propertyName)
    {
        $reflectionProperty = $reflectionClass->getProperty($propertyName);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($entity);
    }
}
