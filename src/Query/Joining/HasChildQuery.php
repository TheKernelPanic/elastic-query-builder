<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Joining;

use ElasticQueryBuilder\Query\Query;

class HasChildQuery extends Query
{
    private const IDENTIFIER = 'has_child';

    public const SCORE_MODE_AVG = 'avg';
    public const SCORE_MODE_MAX = 'max';
    public const SCORE_MODE_MIN = 'min';
    public const SCORE_MODE_NONE = 'none';
    public const SCORE_MODE_SUM = 'sum';

    /**
     * Minimum number of child documents that match the query required to match
     * the query for a returned parent document. If the parent document does not
     * meet this limit, it is excluded from the search results.
     * @var int
     */
    private int $minChildren;

    /**
     * Maximum number of child documents that match the query allowed for a returned
     * parent document. If the parent document exceeds this limit, it is excluded from
     * the search results.
     * @var int
     */
    private int $maxChildren;

    /**
     * Indicates whether to ignore an unmapped type and not return any documents
     * instead of an error.
     * @var bool
     */
    private bool $ignoreUnmapped;

    /**
     * Indicates how scores for matching child documents affect the root parent document’s relevance score.
     * @var string
     */
    private string $scoreMode;

    /**
     * @var Query
     */
    private Query $query;

    /**
     * Name of the child  relationship mapped for the join field.
     * @var string
     */
    private string $childType;

    /**
     * @param Query $query
     * @param string $childType
     */
    public function __construct(Query $query, string $childType)
    {
        $this->query = $query;
        $this->childType = $childType;
    }

    /**
     * @return array[]
     */
    public function normalize(): array
    {
        $normalize = [
          self::IDENTIFIER => [
              'type' => $this->childType,
              'query' => $this->query->normalize()
          ]
        ];
        !isset($this->scoreMode) || ($normalize[self::IDENTIFIER]['score_mode'] = $this->scoreMode);
        !isset($this->ignoreUnmapped) || ($normalize[self::IDENTIFIER]['ignore_unmapped'] = $this->ignoreUnmapped);
        !isset($this->minChildren) || ($normalize[self::IDENTIFIER]['min_children'] = $this->minChildren);
        !isset($this->maxChildren) || ($normalize[self::IDENTIFIER]['max_children'] = $this->maxChildren);

        return $normalize;
    }

    /**
     * @param int $minChildren
     * @return $this
     */
    public function setMinChildren(int $minChildren): self
    {
        $this->minChildren = $minChildren;

        return $this;
    }

    /**
     * @param int $maxChildren
     * @return $this
     */
    public function setMaxChildren(int $maxChildren): self
    {
        $this->maxChildren = $maxChildren;

        return $this;
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