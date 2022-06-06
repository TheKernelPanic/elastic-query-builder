<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Joining;

use ElasticQueryBuilder\Query\Query;

class HasParentQuery extends Query
{
    private const IDENTIFIER = 'has_parent';

    /**
     * Name of the parent relationship mapped for the join field.
     * @var string
     */
    private string $parentType;

    /**
     * Query you wish to run on parent documents of the parent_type field. If
     * a parent document matches the search, the query returns its child documents.
     * @var Query
     */
    private Query $query;

    /**
     * Indicates whether the relevance score of a matching parent document is
     * aggregated into its child documents.
     * @var bool
     */
    private bool $score;

    /**
     * Indicates whether to ignore an unmapped parent_type and not return any
     * documents instead of an error.
     * @var bool
     */
    private bool $ignoreUnmapped;

    /**
     * @param Query $query
     * @param string $parentType
     */
    public function __construct(Query $query, string $parentType)
    {
        $this->query = $query;
        $this->parentType = $parentType;
    }

    /**
     * @return array[]
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                'parent_type' => $this->parentType,
                'query' => $this->query->normalize()
            ]
        ];
        !isset($this->ignoreUnmapped) || ($normalize[self::IDENTIFIER]['ignore_unmapped'] = $this->ignoreUnmapped);
        !isset($this->score) || ($normalize[self::IDENTIFIER]['score'] = $this->score);

        return $normalize;
    }

    /**
     * @param bool $score
     * @return $this
     */
    public function setScore(bool $score): self
    {
        $this->score = $score;

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

    /**
     * TODO: Sort options
     */
}