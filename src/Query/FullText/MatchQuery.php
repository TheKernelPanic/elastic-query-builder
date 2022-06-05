<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\FullText;

use ElasticQueryBuilder\Normalize\NormalizerInterface;
use ElasticQueryBuilder\Query\Query;

class MatchQuery extends Query implements NormalizerInterface
{
    private string $field;

    private string $value;

    /**
     * Match phrase queries are automatically created for multi-term synonyms.
     * @var bool
     */
    private bool $autoGenerateSynonymsPhraseQuery;

    /**
     * Maximum number of terms to which the query will expand.
     * @var int
     */
    private int $maxExpansions;

    /**
     * Number of beginning characters left unchanged for fuzzy matching.
     * @var int
     */
    public int $prefixLength;

    /**
     * TODO: Add rest of configuration...
     */

    /**
     * @param string $field
     * @param string $value
     */
    public function __construct(
        string $field,
        string $value
    )
    {
        $this->field = $field;
        $this->value = $value;
        $this->autoGenerateSynonymsPhraseQuery = true;
        $this->maxExpansions = 50;
        $this->prefixLength = 0;
    }

    /**
     * @return \array[][]
     */
    public function normalize(): array
    {
        return array(
            'match' => array(
                $this->field => array(
                    'query' => $this->value,
                    'auto_generate_synonyms_phrase_query' => $this->autoGenerateSynonymsPhraseQuery
                )
            )
        );
    }

    /**
     * @param bool $autoGenerateSynonymsPhraseQuery
     * @return $this
     */
    public function setAutoGenerateSynonymsPhraseQuery(bool $autoGenerateSynonymsPhraseQuery): self
    {
        $this->autoGenerateSynonymsPhraseQuery = $autoGenerateSynonymsPhraseQuery;

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
     * @param int $prefixLength
     * @return $this
     */
    public function setPrefixLength(int $prefixLength): self
    {
        $this->prefixLength = $prefixLength;

        return $this;
    }
}