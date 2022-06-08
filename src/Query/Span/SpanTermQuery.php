<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Span;

class SpanTermQuery extends SpanQuery
{
    private const IDENTIFIER = 'span_term';

    /**
     * @var string
     */
    private string $field;

    /**
     * @var float
     */
    private float $boost;

    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $field
     * @param string $value
     */
    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                $this->field => $this->value
            ]
        ];
        !isset($this->boost) || ($normalize['boost'] = $this->boost);

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