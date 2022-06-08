<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Span;

class SpanNotQuery extends SpanQuery
{
    private const IDENTIFIER = 'span_not';

    /**
     * @var SpanQuery
     */
    private SpanQuery $include;

    /**
     * @var SpanQuery
     */
    private SpanQuery $exclude;

    /**
     * @param SpanQuery $include
     * @param SpanQuery $exclude
     */
    public function __construct(SpanQuery $include, SpanQuery $exclude)
    {
        $this->include = $include;
        $this->exclude = $exclude;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        return [
            'include' => $this->include->normalize(),
            'exclude' => $this->exclude->normalize()
        ];
    }
}