<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound;

use ElasticQueryBuilder\Normalize\NormalizerInterface;
use ElasticQueryBuilder\Query\Query;

class BooleanQuery extends CompoundQuery implements NormalizerInterface
{
    private const IDENTIFIER = 'bool';

    /**
     * @var string
     */
    private string $minimumShouldMatch;

    /**
     * @var Query[]
     */
    private array $mustOccurrences;

    /**
     * @var Query[]
     */
    private array $mustNotOccurrences;

    /**
     * @var Query[]
     */
    private array $filterOccurrences;

    /**
     * @var Query[]
     */
    private array $shouldOccurrences;

    public function __construct()
    {
        $this->mustOccurrences = [];
        $this->mustNotOccurrences = [];
        $this->filterOccurrences = [];
        $this->shouldOccurrences = [];
    }

    /**
     * @param array $occurrences
     * @param array $normalize
     * @param string $type
     * @return void
     */
    private function occurrencesNormalization(array $occurrences, array &$normalize, string $type): void
    {
        if (!count($occurrences)) {
            return;
        }
        $normalization = [];
        foreach ($this->mustOccurrences as $occurrence) {
            $normalization[] = $occurrence->normalize();
        }
        $normalize[self::IDENTIFIER][$type] = $normalization;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [];

        $this->occurrencesNormalization($this->mustOccurrences, $normalize, 'must');
        $this->occurrencesNormalization($this->mustNotOccurrences, $normalize, 'must_not');
        $this->occurrencesNormalization($this->filterOccurrences, $normalize, 'filter');
        $this->occurrencesNormalization($this->shouldOccurrences, $normalize, 'should');

        !isset($this->minimumShouldMatch) || ($normalize[self::IDENTIFIER]['minimum_should_match'] = $this->minimumShouldMatch);

        return $normalize;
    }

    /**
     * @param string $minimumShouldMatch
     * @return $this
     */
    public function setMinimumShouldMatch(string $minimumShouldMatch): self
    {
        $this->minimumShouldMatch = $minimumShouldMatch;

        return $this;
    }

    /**
     * @param Query $query
     * @return $this
     */
    public function must(Query $query): self
    {
        $this->mustOccurrences[] = $query;

        return $this;
    }

    /**
     * @param Query $query
     * @return $this
     */
    public function mustNot(Query $query): self
    {
        $this->mustNotOccurrences[] = $query;

        return $this;
    }

    /**
     * @param Query $query
     * @return $this
     */
    public function filter(Query $query): self
    {
        $this->filterOccurrences[] = $query;

        return $this;
    }

    /**
     * @param Query $query
     * @return $this
     */
    public function should(Query $query): self
    {
        $this->shouldOccurrences[] = $query;

        return $this;
    }
}