<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\FunctionScore\Functions;

use ElasticQueryBuilder\Normalize\NormalizerInterface;
use ElasticQueryBuilder\Query\Query;

abstract class BaseFunction implements NormalizerInterface
{
    /**
     * @var float
     */
    protected float $weight;

    /**
     * @var Query
     */
    protected Query $filter;

    /**
     * @return string
     */
    abstract protected function getIdentifier(): string;

    /**
     * @param float $value
     * @return $this
     */
    public function weight(float $value): self
    {
        $this->weight = $value;

        return $this;
    }

    /**
     * @param Query $filter
     * @return $this
     */
    public function filter(Query $filter): self
    {
        $this->filter = $filter;

        return $this;
    }
}