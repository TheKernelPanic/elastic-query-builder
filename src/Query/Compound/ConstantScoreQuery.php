<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound;

use ElasticQueryBuilder\Query\Query;

class ConstantScoreQuery extends CompoundQuery
{
    private const IDENTIFIER = 'constant_score';

    /**
     * Filter query you wish to run. Any returned documents must
     * match this query.
     * @var Query
     */
    private Query $filter;

    /**
     * Floating point number used as the constant relevance score for
     * every document matching the filter query. Defaults to 1.0.
     * @var float
     */
    private float $boost;

    /**
     * @param Query $filter
     */
    public function __construct(Query $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @return array|array[]
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                'filter' => $this->filter->normalize()
            ]
        ];
        !isset($this->boost) || ($normalize[self::IDENTIFIER]['boost'] = $this->boost);

        return $normalize;
    }

    /**
     * @param float $boost
     * @return $this
     */
    public function setBoost(float $boost): self
    {
        $this->boost = $boost;

        return $this;
    }
}