<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Span;

class SpanFirstQuery extends SpanQuery
{
    private const IDENTIFIER = 'span_first';

    /**
     * @var SpanQuery
     */
    private SpanQuery $match;

    /**
     * The end controls the maximum end position permitted in a match.
     * @var int
     */
    private int $end;

    /**
     * @param SpanQuery $match
     * @param int $end
     */
    public function __construct(SpanQuery $match, int $end)
    {
        $this->match = $match;
        $this->end = $end;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        return [
            self::IDENTIFIER => [
                'match' => $this->match->normalize(),
                'end' => $this->end
            ]
        ];
    }
}