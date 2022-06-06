<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Types;

use ElasticQueryBuilder\Normalize\NormalizerInterface;

class GeoCoordinates implements GeoPoint, NormalizerInterface
{
    /**
     * @var float
     */
    private float $latitude;

    /**
     * @var float
     */
    private float $longitude;

    /**
     * @var bool
     */
    private bool $asArray;

    /**
     * @param float $latitude
     * @param float $longitude
     * @param bool $asArray
     */
    public function __construct(float $latitude, float $longitude, bool $asArray = false)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->asArray = $asArray;
    }

    /**
     * @return array
     */
    public function getValue(): array
    {
       return $this->normalize();
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        if ($this->asArray) {
            return [$this->longitude, $this->latitude];
        }
        return [
            'lan' => $this->latitude,
            'lon' => $this->longitude
        ];
    }
}