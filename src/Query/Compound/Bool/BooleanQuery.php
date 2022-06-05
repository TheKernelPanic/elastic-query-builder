<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\Bool;

use ElasticQueryBuilder\Normalize\NormalizerInterface;
use ElasticQueryBuilder\Query\Compound\CompoundQuery;
use function array_merge_recursive;

class BooleanQuery extends CompoundQuery implements NormalizerInterface
{
    private array $matchesTypes;

    public function __construct()
    {
        $this->matchesTypes = [];
    }

    /**
     * @param MatchType $matchType
     * @return $this
     */
    public function setMatchType(MatchType $matchType): self
    {
        $this->matchesTypes[] = $matchType;

        return $this;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalized = [];
        foreach ($this->matchesTypes as $matchType) {

            $normalized[] = $matchType->normalize();
        }
        return [
            'bool' => array_merge_recursive(...$normalized)
        ];
    }
}