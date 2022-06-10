<?php
declare(strict_types=1);

namespace ElasticQueryBuilder;

use ElasticQueryBuilder\Normalize\NormalizerInterface;

class QueryParameters implements NormalizerInterface
{
    /**
     * @var int
     */
    private int $trackTotalHits;

    /**
     * @var string
     */
    private string $timeout;

    /**
     * TODO: Indices boost
     */

    /**
     * @param int $trackTotalHits
     * @return $this
     */
    public function trackTotalHits(int $trackTotalHits): self
    {
        $this->trackTotalHits = $trackTotalHits;

        return $this;
    }

    /**
     * @param string $timeout
     * @return $this
     */
    public function timeout(string $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [];

        !isset($this->timeout) || ($normalize['timeout'] = $this->timeout);

        return $normalize;
    }
}