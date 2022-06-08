<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Aggregation\Metric;

use ElasticQueryBuilder\Aggregation\Aggregation;

class BoxplotAggregation extends Aggregation
{
    private const IDENTIFIER = 'boxplot';

    /**
     * @var string
     */
    private string $field;

    /**
     * @var int
     */
    private int $compression;

    /**
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

        return $normalize;
    }

    /**
     * @param int $compression
     * @return $this
     */
    public function setCompression(int $compression): self
    {
        $this->compression = $compression;

        return $this;
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