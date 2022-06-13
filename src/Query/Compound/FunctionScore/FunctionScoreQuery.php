<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\FunctionScore;

use ElasticQueryBuilder\Query\Compound\CompoundQuery;
use ElasticQueryBuilder\Query\Compound\FunctionScore\Functions\BaseFunction;
use ElasticQueryBuilder\Query\Query;

class FunctionScoreQuery extends CompoundQuery
{
    private const IDENTIFIER = 'function_score';

    public const SCORE_MODE_MULTIPLY = 'multiply';
    public const SCORE_MODE_SUM = 'sum';
    public const SCORE_MODE_AVG = 'avg';
    public const SCORE_MODE_FIRST = 'first';
    public const SCORE_MODE_MAX = 'max';
    public const SCORE_MODE_MIN = 'min';

    public const BOOST_MODE_MULTIPLY = 'multiply';
    public const BOOST_MODE_SUM = 'sum';
    public const BOOST_MODE_AVG = 'avg';
    public const BOOST_MODE_REPLACE = 'replace';
    public const BOOST_MODE_MAX = 'max';
    public const BOOST_MODE_MIN = 'min';

    /**
     * @var Query
     */
    private Query $query;

    /**
     * @var BaseFunction[]
     */
    private array $functions;

    /**
     * @var string
     */
    private string $boost;

    /**
     * @var float
     */
    private float $maxBoost;

    /**
     * @var float
     */
    private float $minScore;

    /**
     * @var string
     */
    private string $boostMode;

    /**
     * @var string
     */
    private string $scoreMode;

    /**
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
        $this->functions = [];
    }

    /**
     * @param BaseFunction $function
     * @return $this
     */
    public function addFunction(BaseFunction $function): self
    {
        $this->functions[] = $function;

        return $this;
    }

    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                'query' => $this->query->normalize()
            ]
        ];
        $normalize[self::IDENTIFIER] = array_merge_recursive($normalize[self::IDENTIFIER], $this->getNormalizeFunctions());

        !isset($this->boost) || ($normalize[self::IDENTIFIER]['boost'] = $this->boost);
        !isset($this->maxBoost) || ($normalize[self::IDENTIFIER]['max_boost'] = $this->maxBoost);
        !isset($this->scoreMode) || ($normalize[self::IDENTIFIER]['score_mode'] = $this->scoreMode);
        !isset($this->boostMode) || ($normalize[self::IDENTIFIER]['boost_mode'] = $this->boostMode);
        !isset($this->minScore) || ($normalize[self::IDENTIFIER]['min_score'] = $this->minScore);

        return $normalize;
    }

    /**
     * @return array|array[]
     */
    private function getNormalizeFunctions(): array
    {
        if (count($this->functions) === 1) {
            return $this->functions[0]->normalize();
        }
        $normalize = [
            'functions' => []
        ];
        foreach ($this->functions as $function) {
            $normalize['functions'][] = $function->normalize();
        }
        return $normalize;
    }

    /**
     * @param string $boost
     * @return $this
     */
    public function setBoost(string $boost): self
    {
        $this->boost = $boost;

        return $this;
    }

    /**
     * @param float $maxBoost
     * @return $this
     */
    public function setMaxBoost(float $maxBoost): self
    {
        $this->maxBoost = $maxBoost;

        return $this;
    }

    /**
     * @param float $minScore
     * @return $this
     */
    public function setMinScore(float $minScore): self
    {
        $this->minScore = $minScore;

        return $this;
    }

    /**
     * TODO: Validate
     * @param string $boostMode
     * @return $this
     */
    public function setBoostMode(string $boostMode): self
    {
        $this->boostMode = $boostMode;

        return $this;
    }

    /**
     * TODO: Validate
     * @param string $scoreMode
     * @return $this
     */
    public function setScoreMode(string $scoreMode): self
    {
        $this->scoreMode = $scoreMode;

        return $this;
    }
}