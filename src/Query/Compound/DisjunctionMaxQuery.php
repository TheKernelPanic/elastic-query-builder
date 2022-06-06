<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound;

use ElasticQueryBuilder\Query\Query;

class DisjunctionMaxQuery extends CompoundQuery
{
    private const IDENTIFIER = 'dis_max';

    /**
     * Returned documents must match one or more of these queries. If a document
     * matches multiple queries, Elasticsearch uses the highest relevance score.
     * @var Query[]
     */
    private array $queries;

    /**
     * Floating point number between 0 and 1.0 used to increase the relevance
     * scores of documents matching multiple query clauses
     * @var float
     */
    private float $tieBreaker;

    /**
     * @param array $queries
     */
    public function __construct(array $queries)
    {
        $this->queries = $queries;
    }

    /**
     * @param Query $query
     * @return $this
     */
    public function addQuery(Query $query): self
    {
        $this->queries[] = $query;

        return $this;
    }

    /**
     * @return array|\array[][]
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                'queries' => []
            ]
        ];
        foreach ($this->queries as $query) {
            $normalize[self::IDENTIFIER]['queries'][] = $query->normalize();
        }
        !isset($this->tieBreaker) || ($normalize[self::IDENTIFIER]['tie_breaker'] = $this->tieBreaker);

        return $normalize;
    }

    /**
     * @param float $tieBreaker
     * @return DisjunctionMaxQuery
     */
    public function setTieBreaker(float $tieBreaker): self
    {
        $this->tieBreaker = $tieBreaker;

        return $this;
    }
}