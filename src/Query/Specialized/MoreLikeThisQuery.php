<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Specialized;

use ElasticQueryBuilder\Query\Query;

class MoreLikeThisQuery extends Query
{
    private const IDENTIFIER = 'more_like_this';

    /**
     * @var string[]
     */
    private array $fields;

    /**
     * TODO
     */

    public function normalize(): array
    {
        // TODO: Implement normalize() method.
    }
}