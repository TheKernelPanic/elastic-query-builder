<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Types;

class GeoHash implements GeoPoint
{
    /**
     * @var string
     */
    private string $hash;

    /**
     * @param string $hash
     */
    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->hash;
    }
}