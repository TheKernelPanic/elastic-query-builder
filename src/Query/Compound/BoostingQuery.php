<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound;

use ElasticQueryBuilder\Exception\InvalidParameterException;
use ElasticQueryBuilder\Query\Query;

class BoostingQuery extends CompoundQuery
{
    /**
     * @var Query
     */
    private Query $negative;

    /**
     * @var Query
     */
    private Query $positive;

    /**
     * @var float
     */
    private float $negativeBoost;

    /**
     * @param Query $negative
     * @param Query $positive
     * @param float $negativeBoost
     * @throws InvalidParameterException
     */
    public function __construct(Query $negative, Query $positive, float $negativeBoost)
    {
        $this->negative = $negative;
        $this->positive = $positive;

        if ($negativeBoost > 1 || $negativeBoost < 0) {
            throw new InvalidParameterException('Negative boost must be a number between 0 and 1.0.');
        }
        $this->negativeBoost = $negativeBoost;
    }

    /**
     * @return array[]
     */
    public function normalize(): array
    {
        return [
            'boosting' => [
                'positive' => $this->positive->normalize(),
                'negative' => $this->negative->normalize(),
                'negative_boost' => $this->negativeBoost
            ]
        ];
    }
}