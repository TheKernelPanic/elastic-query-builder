<?php
declare(strict_types=1);

namespace ElasticQueryBuilder;

use ElasticQueryBuilder\Query\Query;
use ElasticQueryBuilder\Sort\Sort;

class QueryBuilder
{
    /**
     * @var array
     */
    private array $mappingQuery;

    /**
     * @var Sort[]
     */
    private array $sorts;

    /**
     * @var array
     */
    private array $built;

    public function __construct()
    {
        $this->sorts = [];
        $this->mappingQuery = [];
    }

    /**
     * @param Sort $sort
     * @return $this
     */
    public function sort(Sort $sort): self
    {
        $this->sorts[] = $sort;

        return $this;
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
        $normalizeQueries = [];
        foreach ($this->mappingQuery as $query) {
            $normalizeQueries[] = $query->normalize();
        }
        $dsl = [
            'query' => array_merge_recursive(...$normalizeQueries)
        ];
        if (count($this->sorts)) {
            $dsl['sort'] = [];
            foreach ($this->sorts as $sort) {
                $dsl['sort'][] = $sort->normalize();
            }
        }
        return $dsl;
    }
}