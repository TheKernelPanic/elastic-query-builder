<?php
declare(strict_types=1);

namespace ElasticQueryBuilder;

use ElasticQueryBuilder\Aggregation\Aggregation;
use ElasticQueryBuilder\Collapse\Collapse;
use ElasticQueryBuilder\Query\Query;
use ElasticQueryBuilder\Sort\Sort;
use function is_null;

class QueryBuilder
{
    /**
     * @var Query
     */
    private Query $query;

    /**
     * @var Sort[]
     */
    private array $sorts;

    /**
     * @var int|null
     */
    private ?int $size;

    /**
     * @var Aggregation[]
     */
    private array $aggregations;

    /**
     * @var Collapse
     */
    private Collapse $collapse;

    /**
     * @var QueryParameters
     */
    private QueryParameters $parameters;

    public function __construct()
    {
        $this->sorts = [];
        $this->size = null;
        $this->parameters = new QueryParameters();
    }

    /**
     * @return QueryParameters
     */
    public function getParameters(): QueryParameters
    {
        return $this->parameters;
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
    public function query(Query $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return array
     */
    public function getDsl(): array
    {
        $dsl = [
            'query' => $this->query->normalize()
        ];
        if (count($this->sorts)) {
            $dsl['sort'] = [];
            foreach ($this->sorts as $sort) {
                $dsl['sort'][] = $sort->normalize();
            }
        }
        is_null($this->size) || ($dsl['size'] = $this->size);

        $dsl = array_merge_recursive($dsl, $this->parameters->normalize());

        return $dsl;
    }

    /**
     * @param int|null $size
     * @return $this
     */
    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @param Aggregation $aggregation
     * @return $this
     */
    public function aggregation(Aggregation $aggregation): self
    {
        $this->aggregations[] = $aggregation;

        return $this;
    }

    /**
     * @param Collapse $collapse
     * @return $this
     */
    public function collapse(Collapse $collapse): self
    {
        $this->collapse = $collapse;

        return $this;
    }
}