<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Aggregation\Metric;

use ElasticQueryBuilder\Aggregation\Aggregation;

class AverageAggregation extends Aggregation
{
    private const IDENTIFIER = 'avg';

    /**
     * @var string
     */
    private string $field;

    /**
     * The missing parameter defines how documents that are missing a value
     * should be treated. By default they will be ignored but it is also
     * possible to treat them as if they had a value.
     * @var int
     */
    private int $missing;

    /**
     * @param string $name
     * @param string $field
     */
    public function __construct(string $name, string $field)
    {
        $this->name = $name;
        $this->field = $field;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            $this->name => [
                self::IDENTIFIER => [
                    'field' => $this->field
                ]
            ]
        ];
        !isset($this->missing) || ($normalize[$this->name][self::IDENTIFIER]['missing'] = $this->missing);

        return $normalize;
    }

    /**
     * @param int $missing
     * @return $this
     */
    public function setDefaultMissingValue(int $missing): self
    {
        $this->missing = $missing;

        return $this;
    }
}