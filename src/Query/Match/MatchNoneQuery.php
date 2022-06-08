<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Match;

use ElasticQueryBuilder\Query\Query;

class MatchNoneQuery extends Query
{
    private const IDENTIFIER = 'match_none';

    /**
     * @return array
     */
    public function normalize(): array
    {
        return [
            self::IDENTIFIER => []
        ];
    }
}