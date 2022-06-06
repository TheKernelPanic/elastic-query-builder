<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Types;

interface GeoPoint
{
    /**
     * @return mixed
     */
    public function getValue(): mixed;
}