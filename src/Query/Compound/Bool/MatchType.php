<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\Bool;

use ElasticQueryBuilder\Normalize\NormalizerInterface;
use ElasticQueryBuilder\Query\Query;

abstract class MatchType implements NormalizerInterface
{
    /**
     * @var array
     */
    protected array $aggregations;

    /**
     * @var string
     */
    protected string $key;

    /**
     *
     */
    public function __construct()
    {
        $this->aggregations = [];
    }

    /**
     * @param Query $query
     * @return $this
     */
    public function aggregate(Query $query): self
    {
        $this->aggregations[] = $query;

        return $this;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalized = [
            $this->key => []
        ];
        foreach ($this->aggregations as $aggregation) {
            $normalized[$this->key][] = $aggregation->normalize();
        }
        return $normalized;
    }
}