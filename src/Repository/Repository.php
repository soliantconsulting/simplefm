<?php
declare(strict_types=1);

namespace Soliant\SimpleFM\Repository;

use Soliant\SimpleFM\Client\ResultSet\ResultSetClient;
use Soliant\SimpleFM\Connection\Command;
use Soliant\SimpleFM\Repository\Query\FindQuery;
use SplObjectStorage;

final class Repository
{
    /**
     * @var ResultSetClient
     */
    private $resultSetClient;

    /**
     * @var string
     */
    private $layout;

    /**
     * @var HydrationInterface
     */
    private $hydration;

    /**
     * @var ExtractionInterface
     */
    private $extraction;

    /**
     * @var SplObjectStorage
     */
    private $managedEntities;

    public function __construct(
        ResultSetClient $resultSetClient,
        string $layout,
        HydrationInterface $hydration,
        ExtractionInterface $extraction
    ) {
        $this->resultSetClient = $resultSetClient;
        $this->layout = $layout;
        $this->hydration = $hydration;
        $this->extraction = $extraction;
        $this->managedEntities = new SplObjectStorage();
    }

    public function find(int $recordId)
    {
        return $this->findOneBy(['-recid' => $recordId]);
    }

    public function findOneBy(array $search)
    {
        $resultSet = $this->resultSetClient->execute(new Command(
            $this->layout,
            $this->createSearchParameters($search) + ['-find' =>  null, '-max' => 1]
        ));

        if (empty($resultSet)) {
            return null;
        }

        return $this->createEntity($resultSet[0]);
    }

    public function findOneByQuery(FindQuery $query)
    {
        $resultSet = $this->resultSetClient->execute(new Command(
            $this->layout,
            $query->toParameters() + ['-findquery' =>  null, '-max' => 1]
        ));

        if (empty($resultSet)) {
            return null;
        }

        return $this->createEntity($resultSet[0]);
    }

    public function findAll(array $sort = [], int $limit = null, int $offset = null) : array
    {
        $resultSet = $this->resultSetClient->execute(new Command(
            $this->layout,
            (
                $this->createSortParameters($sort)
                + $this->createLimitAndOffsetParameters($limit, $offset)
                +  ['-findall' => null]
            )
        ));

        return $this->createCollection($resultSet);
    }

    public function findBy(array $search, array $sort = [], int $limit = null, int $offset = null) : array
    {
        $resultSet = $this->resultSetClient->execute(new Command(
            $this->layout,
            (
                $this->createSearchParameters($search)
                + $this->createSortParameters($sort)
                + $this->createLimitAndOffsetParameters($limit, $offset)
                +  ['-find' => null]
            )
        ));

        return $this->createCollection($resultSet);
    }

    public function findByQuery(FindQuery $findQuery, array $sort = [], int $limit = null, int $offset = null) : array
    {
        $resultSet = $this->resultSetClient->execute(new Command(
            $this->layout,
            (
                $findQuery->toParameters()
                + $this->createSortParameters($sort)
                + $this->createLimitAndOffsetParameters($limit, $offset)
                +  ['-findquery' => null]
            )
        ));

        return $this->createCollection($resultSet);
    }

    public function insert($entity)
    {
        $this->persist($entity, '-new');
    }

    public function update($entity)
    {
        if (!isset($this->managedEntities[$entity])) {
            // @todo throw exception
        }

        $this->persist($entity, '-edit', [
            '-recid' => $this->managedEntities[$entity]['record-id'],
            '-modid' => $this->managedEntities[$entity]['mod-id'],
        ]);
    }

    public function delete($entity)
    {
        if (!isset($this->managedEntities[$entity])) {
            // @todo throw exception
        }

        $this->resultSetClient->execute(new Command(
            $this->layout,
            [
                '-recid' => $this->managedEntities[$entity]['record-id'],
                '-modid' => $this->managedEntities[$entity]['mod-id'],
                '-delete' => null
            ]
        ));
        unset($this->managedEntities[$entity]);
    }

    private function persist($entity, string $mode, $additionalParameters)
    {
        $resultSet = $this->resultSetClient->execute(new Command(
            $this->layout,
            $this->extraction->extract($entity) + $additionalParameters + [$mode => null]
        ));

        if (empty($resultSet)) {
            // @todo throw exception
        }

        $this->hydration->hydrate($resultSet[0], $entity);
        $this->addOrUpdateManagedEntity($resultSet[0]['record-id'], $resultSet[0]['mod-id'], $entity);
    }

    private function addOrUpdateManagedEntity(int $recordId, int $modId, $entity)
    {
        $this->managedEntities[$entity] = [
            'record-id' => $recordId,
            'mod-id' => $modId,
        ];
    }

    private function createCollection(array $resultSet) : array
    {
        $collection = [];

        foreach ($resultSet as $record) {
            $collection[] = $this->createEntity($record);
        }

        return $collection;
    }

    private function createEntity(array $record)
    {
        $entity = $this->hydration->hydrate($record);
        $this->addOrUpdateManagedEntity($record['record-id'], $record['mod-id'], $entity);
        return $entity;
    }

    private function createSearchParameters(array $search) : array
    {
        $searchParameters = [];

        foreach ($search as $field => $value) {
            $searchParameters[$field] = str_replace('@', '\@', $value);
        }

        return $searchParameters;
    }

    private function createSortParameters(array $sort) : array
    {
        if (count($sort) > 9) {
            // @todo throw exception
        }

        $index = 1;
        $parameters = [];

        foreach ($sort as $field => $order) {
            $parameters['-sortfield' . $index] = $field;
            $parameters['-sortorder' . $index] = $order;
            ++$index;
        }

        return $parameters;
    }

    private function createLimitAndOffsetParameters(int $limit = null, int $offset = null) : array
    {
        $parameters = [];

        if (null !== $limit) {
            $parameters['-max'] = $limit;
        }

        if (null !== $offset) {
            $parameters['-skip'] = $offset;
        }

        return $parameters;
    }
}
