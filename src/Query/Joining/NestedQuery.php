<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Joining;

use ElasticQueryBuilder\Query\Query;

class NestedQuery extends Query
{
    public const SCORE_MODE_AVG = 'avg';
    public const SCORE_MODE_MAX = 'max';
    public const SCORE_MODE_MIN = 'min';
    public const SCORE_MODE_NONE = 'none';
    public const SCORE_MODE_SUM = 'sum';

    /**
     * Path to nested object you wish to search
     * @var string
     */
    private string $path;

    /**
     * Query object you wish to run on nested objects in the path.
     *
     * @var Query
     */
    private Query $query;

    /**
     * Indicates how scores for matching child objects affect the root parent document's
     * @var string
     */
    private string $scoreMode;

    /**
     * Indicates whether to ignore an unmapped path and not return any documents instead of an error.
     * @var bool
     */
    private bool $ignoreUnmapped;

    /**
     * @param string $path
     * @param Query $query
     */
    public function __construct(string $path, Query $query)
    {
        $this->path = $path;
        $this->query = $query;
        $this->scoreMode = self::SCORE_MODE_AVG;
        $this->ignoreUnmapped = false;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        return [
            'nested' => [
                'path' => $this->path,
                'query' => $this->query->normalize(),
                'score_mode' => $this->scoreMode,
                'ignore_unmapped' => $this->ignoreUnmapped
            ]
        ];
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

    /**
     * @param string $scoreMode
     * @return $this
     */
    public function setScoreMode(string $scoreMode): self
    {
        /**
         * TODO: Validate
         */
        $this->scoreMode = $scoreMode;

        return $this;
    }
}