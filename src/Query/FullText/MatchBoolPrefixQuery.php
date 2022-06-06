<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\FullText;

use ElasticQueryBuilder\Normalize\NormalizerInterface;
use ElasticQueryBuilder\Query\Query;

class MatchBoolPrefixQuery extends Query
{
    private const IDENTIFIER = 'match_bool_prefix';

    /**
     * @var string
     */
    private string $field;

    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $field
     * @param string $value
     */
    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string[][]
     */
    public function normalize(): array
    {
        return [
            self::IDENTIFIER => [
                $this->field => $this->value
            ]
        ];
    }

    /**
     * TODO: Analyzer
     */
}