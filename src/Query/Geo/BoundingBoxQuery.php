<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Geo;

use ElasticQueryBuilder\Query\Query;
use ElasticQueryBuilder\Types\GeoPoint;

class BoundingBoxQuery extends Query
{
    private const IDENTIFIER = 'geo_bounding_box';

    /**
     * @var GeoPoint
     */
    private GeoPoint $topLeft;

    /**
     * @var GeoPoint
     */
    private GeoPoint $bottomRight;

    /**
     * @var bool
     */
    private bool $ignoreUnmapped;

    /**
     * TODO: Add support
     * @var string
     */
    private string $wellKnownText;

    /**
     * @param GeoPoint $topLeft
     * @param GeoPoint $bottomRight
     */
    public function __construct(GeoPoint $topLeft, GeoPoint $bottomRight)
    {
        $this->topLeft = $topLeft;
        $this->bottomRight = $bottomRight;
    }

    /**
     * @return array|array[]
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                'top_left' => $this->topLeft->getValue(),
                'bottom_right' => $this->bottomRight->getValue()
            ]
        ];
        !isset($this->ignoreUnmapped) || ($normalize[self::IDENTIFIER]['ignore_unmapped'] = $this->ignoreUnmapped);

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