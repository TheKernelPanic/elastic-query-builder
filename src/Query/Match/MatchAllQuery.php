<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Match;

use ElasticQueryBuilder\Query\Query;

class MatchAllQuery extends Query
{
    private const IDENTIFIER = 'match_all';

    /**
     * @var float
     */
    private float $boost;

    /**
     * @return array|array[]
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => []
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