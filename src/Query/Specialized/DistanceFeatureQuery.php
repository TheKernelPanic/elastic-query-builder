<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Specialized;

use ElasticQueryBuilder\Query\Query;

class DistanceFeatureQuery extends Query
{
    private const IDENTIFIER = 'distance_feature';

    /**
     * Name of the field used to calculate distances.
     * @var string
     */
    private string $field;

    /**
     * Date or point of origin used to calculate distances.
     * @var string
     */
    private string $origin;

    /**
     * Distance from the origin at which relevance scores receive half of the boost value.
     * @var string
     */
    private string $pivot;

    /**
     * Floating point number used to multiply the relevance score of matching documents.
     * @var float
     */
    private float $boost;

    /**
     * TODO: Origin
     * @param string $field
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * @return array|\string[][]
     */
    public function normalize(): array
    {
        $normalize = [
             self::IDENTIFIER => [
                'field' => $this->field
            ]
        ];
        !isset($this->pivot) || ($normalize[self::IDENTIFIER]['pivot'] = $this->pivot);
        !isset($this->boost) || ($normalize[self::IDENTIFIER]['boost'] = $this->boost);

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