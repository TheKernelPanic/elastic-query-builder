<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Collapse;

use ElasticQueryBuilder\Normalize\NormalizerInterface;

class Collapse implements NormalizerInterface
{
    /**
     * TODO: Inner hists
     */

    /**
     * @var string
     */
    private string $field;

    /**
     * @var int
     */
    private int $maxConcurrentGroupSearches;

    /**
     * @param string $field
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * @return string[]
     */
    public function normalize(): array
    {
        $normalize = [
            'field' => $this->field
        ];
        !isset($this->maxConcurrentGroupSearches) || ($normalize['max_concurrent_group_searches'] = $this->maxConcurrentGroupSearches);

        return $normalize;
    }

    /**
     * @param int $maxConcurrentGroupSearches
     * @return $this
     */
    public function setMaxConcurrentGroupSearches(int $maxConcurrentGroupSearches): self
    {
        $this->maxConcurrentGroupSearches = $maxConcurrentGroupSearches;

        return $this;
    }
}