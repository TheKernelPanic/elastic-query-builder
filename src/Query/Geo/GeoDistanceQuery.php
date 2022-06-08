<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Geo;

use ElasticQueryBuilder\Query\Query;
use ElasticQueryBuilder\Types\GeoPoint;

class GeoDistanceQuery extends Query
{
    private const IDENTIFIER = 'geo_distance';

    public const DISTANCE_TYPE_ARC = 'arc';
    public const DISTANCE_TYPE_PLANE = 'plane';

    /**
     * The radius of the circle centred on the specified location.
     * @var string
     */
    private string $distance;

    /**
     * How to compute the distance. Can either be arc (default), or plane
     * (faster, but inaccurate on long distances and close to the poles).
     * @var string
     */
    private string $distanceType;

    /**
     * @var GeoPoint
     */
    private GeoPoint $location;

    /**
     * @var string
     */
    private string $field;

    public function __construct(string $field, string $distance, GeoPoint $location)
    {
        $this->field = $field;
        $this->distance = $distance;
        $this->location = $location;
    }

    /**
     * @return array|array[]
     */
    public function normalize(): array
    {
       $normalize = [
           self::IDENTIFIER => [
               'distance' => $this->distance,
               $this->field => $this->location->getValue()
           ]
       ];
       !isset($this->distanceType) || ($normalize[self::IDENTIFIER]['distance_type'] = $this->distanceType);

       return $normalize;
    }

    /**
     * @param string $distanceType
     * @return $this
     */
    public function setDistanceType(string $distanceType): self
    {
        /**
         * TODO: Validate
         */
        $this->distanceType = $distanceType;

        return $this;
    }
}