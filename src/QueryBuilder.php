<?php
declare(strict_types=1);

namespace ElasticQueryBuilder;

use ElasticQueryBuilder\Query\Query;

class QueryBuilder
{
    /**
     * @var array
     */
    private array $mappingQuery;

    /**
     * @var array
     */
    private array $built;

    public function __construct()
    {
        $this->mappingQuery = [];
    }

    /**
     * @param Query $query
     * @return $this
     */
    public function add(Query $query): self
    {
        $this->mappingQuery[] = $query;

        return $this;
    }

    /**
     * @return array
     */
    public function getDsl(): array
    {
        $normalized = array();
        foreach ($this->mappingQuery as $query) {
            $normalized[] = $query->normalize();
        }
        return array_merge_recursive(...$normalized);
    }
}