<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\FullText;

use ElasticQueryBuilder\Normalize\NormalizerInterface;
use ElasticQueryBuilder\Query\Query;

class MatchQuery extends Query implements NormalizerInterface
{
    private const IDENTIFIER = 'match';

    public const ZERO_TERMS_QUERY_NONE = 'none';
    public const ZERO_TERMS_QUERY_ALL = 'all';

    public const OR = 'or';
    public const AND = 'and';

    public const FUZZINESS_AUTO = 'AUTO';

    /**
     * @var string
     */
    private string $field;

    /**
     * @var string
     */
    private string $value;

    /**
     * @var bool
     */
    private bool $autoGenerateSynonymsPhraseQuery;

    /**
     * @var int
     */
    private int $maxExpansions;

    /**
     * @var int
     */
    public int $prefixLength;

    /**
     * @var string
     */
    private string $zeroTermsQuery;

    /**
     * @var bool
     */
    private bool $fuzzyTranspositions;

    /**
     * @var bool
     */
    private bool $lenient;

    /**
     * @var string
     */
    private string $analyzer;

    /**
     * @var string
     */
    private string $minimumShouldMatch;

    /**
     * @var string
     */
    private string $fuzziness;

    /**
     * @var string
     */
    private string $fuzzinessRewrite;

    /**
     * @var string
     */
    private string $operator;

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
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => array(
                $this->field => array(
                    'query' => $this->value
                )
            )
        ];
        !isset($this->autoGenerateSynonymsPhraseQuery) || ($normalize[self::IDENTIFIER][$this->field]['auto_generate_synonyms_phrase_query'] = $this->autoGenerateSynonymsPhraseQuery);
        !isset($this->zeroTermsQuery) || ($normalize[self::IDENTIFIER][$this->field]['zero_terms_query'] = $this->zeroTermsQuery);
        !isset($this->maxExpansions) || ($normalize[self::IDENTIFIER][$this->field]['max_expansions'] = $this->maxExpansions);
        !isset($this->fuzzyTranspositions) || ($normalize[self::IDENTIFIER][$this->field]['fuzzy_transpositions'] = $this->fuzzyTranspositions);
        !isset($this->prefixLength) || ($normalize[self::IDENTIFIER][$this->field]['prefix_length'] = $this->prefixLength);
        !isset($this->lenient) || ($normalize[self::IDENTIFIER][$this->field]['lenient'] = $this->lenient);
        !isset($this->analyzer) || ($normalize[self::IDENTIFIER][$this->field]['analyzer'] = $this->analyzer);
        !isset($this->minimumShouldMatch) || ($normalize[self::IDENTIFIER][$this->field]['minimum_should_match'] = $this->minimumShouldMatch);
        !isset($this->fuzziness) || ($normalize[self::IDENTIFIER][$this->field]['fuzziness'] = $this->fuzziness);
        !isset($this->fuzzinessRewrite) || ($normalize[self::IDENTIFIER][$this->field]['fuzziness_rewrite'] = $this->fuzzinessRewrite);
        !isset($this->operator) || ($normalize[self::IDENTIFIER][$this->field]['operator'] = $this->operator);

        return $normalize;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setAutoGenerateSynonymsPhraseQuery(bool $value): self
    {
        $this->autoGenerateSynonymsPhraseQuery = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setMaxExpansions(int $value): self
    {
        $this->maxExpansions = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setPrefixLength(int $value): self
    {
        $this->prefixLength = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setZeroTermsQuery(string $value): self
    {
        $this->zeroTermsQuery = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setFuzzyTranspositions(bool $value): self
    {
        $this->fuzzyTranspositions = $value;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setLenient(bool $value): self
    {
        $this->lenient = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setMinimumShouldMatch(string $value): self
    {
        $this->minimumShouldMatch = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setAnalyzer(string $value): self
    {
        $this->analyzer = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setFuzziness(string $value): self
    {
        $this->fuzziness = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return void
     */
    public function setFuzzinessRewrite(string $value): void
    {
        $this->fuzzinessRewrite = $value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOperator(string $value): self
    {
        $this->operator = $value;

        return $this;
    }
}