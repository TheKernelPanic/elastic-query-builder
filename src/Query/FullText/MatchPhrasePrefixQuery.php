<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\FullText;

use ElasticQueryBuilder\Query\Query;

class MatchPhrasePrefixQuery extends Query
{
    private const IDENTIFIER = 'match_phrase_prefix';
    public const ZERO_TERMS_QUERY_NONE = 'none';
    public const ZERO_TERMS_QUERY_ALL = 'all';

    /**
     * @var Query
     */
    private Query $query;

    /**
     * Analyzer used to convert text in the query value into tokens.
     * Defaults to the index-time analyzer mapped for the <field>
     * @var string
     */
    private string $analyzer;

    /**
     * Maximum number of terms to which the last provided term of
     * the query value will expand.
     * @var int
     */
    private int $maxExpansions;

    /**
     * Maximum number of positions allowed between matching tokens.
     * @var int
     */
    private int $slop;

    /**
     * Indicates whether no documents are returned if the analyzer
     * removes all tokens, such as when using a stop filter.
     * @var string
     */
    private string $zeroTermsQuery;

    /**
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                'query' => $this->query->normalize()
            ]
        ];
        !isset($this->analyzer) || ($normalize[self::IDENTIFIER]['analyzer'] = $this->analyzer);
        !isset($this->maxExpansions) || ($normalize[self::IDENTIFIER]['max_expansions'] = $this->maxExpansions);
        !isset($this->slop) || ($normalize[self::IDENTIFIER]['slop'] = $this->slop);
        !isset($this->zeroTermsQuery) || ($normalize[self::IDENTIFIER]['zero_terms_query'] = $this->zeroTermsQuery);

        return $normalize;
    }

    /**
     * @param string $analyzer
     * @return $this
     */
    public function setAnalyzer(string $analyzer): self
    {
        $this->analyzer = $analyzer;

        return $this;
    }

    /**
     * @param int $maxExpansions
     * @return $this
     */
    public function setMaxExpansions(int $maxExpansions): self
    {
        $this->maxExpansions = $maxExpansions;

        return $this;
    }

    /**
     * @param int $slop
     * @return $this
     */
    public function setSlop(int $slop): self
    {
        $this->slop = $slop;

        return $this;
    }

    /**
     * @param string $zeroTermsQuery
     * @return $this
     */
    public function setZeroTermsQuery(string $zeroTermsQuery): self
    {
        $this->zeroTermsQuery = $zeroTermsQuery;

        return $this;
    }
}