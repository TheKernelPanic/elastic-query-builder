<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Span;

use ElasticQueryBuilder\Normalize\NormalizerInterface;

class SpanContainingQuery extends SpanQuery
{
    private const IDENTIFIER = 'span_containing';

    /**
     * Can be any span type query.
     * @var SpanQuery
     */
    private SpanQuery $little;

    /**
     * Can be any span type query.
     * @var SpanQuery
     */
    private SpanQuery $big;

    /**
     * @param SpanQuery $little
     * @param SpanQuery $big
     */
    public function __construct(SpanQuery $little, SpanQuery $big)
    {
        $this->little = $little;
        $this->big = $big;
    }

    /**
     * @return array[]
     */
    public function normalize(): array
    {
        return [
            self::IDENTIFIER => [
                'little' => $this->little->normalize(),
                'big' => $this->big->normalize()
            ]
        ];
    }
}