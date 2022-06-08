<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Aggregation;

use ElasticQueryBuilder\Normalize\NormalizerInterface;

abstract class Aggregation implements NormalizerInterface
{
    /**
     * @var string
     */
    protected string $name;
}