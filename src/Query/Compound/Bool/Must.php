<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\Bool;

class Must extends MatchType
{
    /**
     * @var string
     */
    protected string $key = 'must';
}