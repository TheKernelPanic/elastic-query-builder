<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\TermLevel;

use ElasticQueryBuilder\Common\RewriteParameter;
use ElasticQueryBuilder\Query\Query;

class PrefixQuery extends Query
{
    use RewriteParameter;

    private const IDENTIFIER = 'prefix';

    /**
     * @var string
     */
    private string $field;

    /**
     * @var string
     */
    private string $prefix;

    /**
     * Allows ASCII case insensitive matching of the value with the indexed
     * field values when set to true. Default is false which means the case
     * sensitivity of matching depends on the underlying field’s mapping.
     * @var bool
     */
    private bool $caseInsensitive;

    public function __construct(string $field, string $prefix)
    {
        $this->field = $field;
        $this->prefix = $prefix;
    }

    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                $this->field => [
                    'value' => $this->prefix
                ]
            ]
        ];
        !isset($this->caseInsensitive) || ($normalize[self::IDENTIFIER][$this->field]['case_insensitive'] = $this->caseInsensitive);
        !isset($this->rewrite) || ($normalize[self::IDENTIFIER][$this->field]['rewrite'] = $this->rewrite);

        return $normalize;
    }
}