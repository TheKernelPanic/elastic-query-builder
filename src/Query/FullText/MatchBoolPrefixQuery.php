<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\FullText;

use ElasticQueryBuilder\Normalize\NormalizerInterface;
use ElasticQueryBuilder\Query\Query;

class MatchBoolPrefixQuery extends Query
{
    private string $field;

    private string $value;

    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public function normalize(): array
    {
        return [
            'match_bool_prefix' => [
                $this->field => $this->value
            ]
        ];
    }
}