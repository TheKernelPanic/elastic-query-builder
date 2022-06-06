<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Span;

class NearQuery extends SpanQuery
{
    private const IDENTIFIER = 'span_near';

    /**
     * @var SpanQuery[]
     */
    private array $clauses;

    /**
     * @var int
     */
    private int $slop;

    /**
     * @var bool
     */
    private bool $inOrder;

    /**
     * TODO:
     * @return array
     */

    public function __construct(SpanQuery ...$clauses)
    {
        $this->clauses = [$clauses];
        $this->inOrder = false;
    }

    /**
     * @return array|array[]
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                'clauses' => [],
                'in_order' => $this->inOrder
            ]
        ];
        foreach ($this->clauses as $clause) {
            $normalize[self::IDENTIFIER]['clauses'][] = $clause->normalize();
        }
        !isset($this->slop) || ($normalize[self::IDENTIFIER]['slop'] = $this->slop);

        return $normalize;
    }

    /**
     * @param int $slop
     * @return $this
     */
    public function setSlop(int $slop): self
    {
        $this->slop = $slop;

        return $this;
    }

    /**
     * @param bool $inOrder
     * @return $this
     */
    public function setInOrder(bool $inOrder): self
    {
        $this->inOrder = $inOrder;

        return $this;
    }
}