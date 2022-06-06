<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\FullText;

use ElasticQueryBuilder\Exception\InvalidParameterException;
use ElasticQueryBuilder\Query\Query;
use function is_string, array_walk;

class CombinedFieldsQuery extends Query
{
    private const IDENTIFIER = 'combined_fields';

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
        $this->operator = self::OR;
    }

    public function normalize(): array
    {
        return [
            self::IDENTIFIER => [
                'query' => $this->value,
                'fields' => $this->fields,
                'operator' => $this->operator
            ]
        ];
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
}