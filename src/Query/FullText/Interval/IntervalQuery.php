<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\FullText\Interval;

use ElasticQueryBuilder\Query\Query;

abstract class IntervalQuery extends Query
{
    /**
     * @var string
     */
    protected string $field;

    /**
     * @param string $field
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }
}