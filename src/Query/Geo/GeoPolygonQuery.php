<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Geo;

use ElasticQueryBuilder\Query\Query;
use ElasticQueryBuilder\Types\GeoPoint;

class GeoPolygonQuery extends Query
{
    private const IDENTIFIER = 'geo_polygon';

    /**
     * @var GeoPoint[]
     */
    private array $points;

    /**
     * @var string
     */
    private string $field;

    /**
     * @var bool
     */
    private bool $ignoreUnmapped;

    /**
     * @param string $field
     * @param array $points
     */
    public function __construct(string $field, array $points)
    {
        $this->field = $field;
        /**
         * TODO: Validate
         */
        $this->points = $points;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                $this->field => [
                    'points' => []
                ]
            ]
        ];
        foreach ($this->points as $point) {
            $normalize[self::IDENTIFIER][$this->field]['points'][] = $point->getValue();
        }
        !isset($this->ignoreUnmapped) || ($normalize['ignore_unmapped'] = $this->ignoreUnmapped);

        return $normalize;
    }

    /**
     * @param bool $ignoreUnmapped
     * @return $this
     */
    public function setIgnoreUnmapped(bool $ignoreUnmapped): self
    {
        $this->ignoreUnmapped = $ignoreUnmapped;

        return $this;
    }
}