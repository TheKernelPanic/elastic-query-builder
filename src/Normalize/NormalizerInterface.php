<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Normalize;

interface NormalizerInterface
{
    /**
     * @return array
     */
    public function normalize(): array;
}