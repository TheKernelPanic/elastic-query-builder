<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\FullText;

use ElasticQueryBuilder\Normalize\NormalizerInterface;
use ElasticQueryBuilder\Query\Query;

class MatchPhraseQuery extends Query
{
    private string $field;

    private mixed $value;

    /**
     * @param string $field
     * @param mixed $value
     */
    public function __construct(string $field, mixed $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return \array[][]
     */
    public function normalize(): array
    {
        return [
            'match_phrase' => [
                $this->field => [
                    'query' => $this->value
                ]
            ]
        ];
    }
}