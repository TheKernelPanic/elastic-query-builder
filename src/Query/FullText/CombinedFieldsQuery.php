<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\FullText;

use ElasticQueryBuilder\Exception\InvalidParameterException;
use ElasticQueryBuilder\Query\Query;
use function is_string, array_walk;

class CombinedFieldsQuery extends Query
{
    private const IDENTIFIER = 'combined_fields';

    public const ZERO_TERMS_QUERY_NONE = 'none';
    public const ZERO_TERMS_QUERY_ALL = 'all';

    public const OR = 'or';
    public const AND = 'and';

    /**
     * @var array
     */
    private array $fields;

    /**
     * @var mixed
     */
    private mixed $value;

    /**
     * @var string
     */
    private string $operator;

    /**
     * @var string
     */
    private string $zeroTermsQuery;

    /**
     * @var bool
     */
    private bool $autoGenerateSynonymsPhraseQuery;

    /**
     * @var string
     */
    private string $minimumShouldMatch;

    /**
     * @param array $fields
     * @param mixed $value
     * @throws InvalidParameterException
     */
    public function __construct(array $fields, mixed $value)
    {
        array_walk($fields, static function(mixed $element) {
            if (!is_string($element)) {
                throw new InvalidParameterException('Fields must be an list of strings');
            }
        });
        $this->fields = $fields;
        $this->value = $value;
    }

    /**
     * @return array[]
     */
    public function normalize(): array
    {
        $normalize =  [
            self::IDENTIFIER => [
                'query' => $this->value,
                'fields' => $this->fields
            ]
        ];
        !isset($this->operator) || ($normalize['operator'] = $this->operator);
        !isset($this->zeroTermsQuery) || ($normalize['zero_terms_query'] = $this->zeroTermsQuery);
        !isset($this->autoGenerateSynonymsPhraseQuery) || ($normalize['auto_generate_synonyms_phrase_query'] = $this->autoGenerateSynonymsPhraseQuery);
        !isset($this->minimumShouldMatch) || ($normalize['minimum_should_match'] = $this->minimumShouldMatch);

        return $normalize;
    }

    /**
     * @param string $operator
     * @return void
     * @throws InvalidParameterException
     */
    public function setOperator(string $operator): void
    {
        if ($operator !== self::OR || $operator !== self::AND) {
            throw new InvalidParameterException('Operators allowed {and, or}');
        }
        $this->operator = $operator;
    }

    /**
     * @param string $zeroTermsQuery
     * @return $this
     * @throws InvalidParameterException
     */
    public function setZeroTermsQuery(string $zeroTermsQuery): self
    {
        if ($zeroTermsQuery !== self::ZERO_TERMS_QUERY_NONE || $zeroTermsQuery !== self::ZERO_TERMS_QUERY_ALL) {
            throw new InvalidParameterException('zero_terms_query allowed {all, none}');
        }
        $this->zeroTermsQuery = $zeroTermsQuery;

        return $this;
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
     * @param string $minimumShouldMatch
     * @return $this
     */
    public function setMinimumShouldMatch(string $minimumShouldMatch): self
    {
        /**
         * TODO: Validate
         */
        $this->minimumShouldMatch = $minimumShouldMatch;

        return $this;
    }
}