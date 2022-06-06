<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\TermLevel;

use ElasticQueryBuilder\Query\Query;

class RangeQuery extends Query
{
    private const IDENTIFIER = 'range';

    public const RELATION_TYPE_INTERSECTS = 'INTERSECTS';
    public const RELATION_TYPE_CONTAINS = 'CONTAINS';
    public const RELATION_TYPE_WITHIN = 'WITHIN';

    /**
     * Field you wish to search.
     * @var string
     */
    private string $field;

    /**
     * @var string
     */
    private string $relation;

    /**
     * @var string
     */
    private string $timezone;

    /**
     * @var float
     */
    private float $boost;

    /**
     * @var mixed
     */
    private mixed $greaterThan;

    /**
     * @var mixed
     */
    private mixed $greaterThanOrEqualTo;

    /**
     * @var mixed
     */
    private mixed $lessThan;

    /**
     * @var mixed
     */
    private mixed $lessThanOrEqualTo;

    /**
     * @var string
     */
    private string $format;

    /**
     * @param string $field
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * @return array|\array[][]
     */
    public function normalize(): array
    {
        $normalize = [
            self::IDENTIFIER => [
                $this->field => []
            ]
        ];
        !isset($this->greaterThan) || ($normalize[self::IDENTIFIER][$this->field]['gt'] = $this->greaterThan);
        !isset($this->greaterThanOrEqualTo) || ($normalize[self::IDENTIFIER][$this->field]['gte'] = $this->greaterThanOrEqualTo);
        !isset($this->lessThan) || ($normalize[self::IDENTIFIER][$this->field]['lt'] = $this->lessThan);
        !isset($this->lessThanOrEqualTo) || ($normalize[self::IDENTIFIER][$this->field]['lte'] = $this->lessThanOrEqualTo);
        !isset($this->format) || ($normalize[self::IDENTIFIER][$this->field]['format'] = $this->format);
        !isset($this->timezone) || ($normalize[self::IDENTIFIER][$this->field]['time_zone'] = $this->timezone);
        !isset($this->relation) || ($normalize[self::IDENTIFIER][$this->field]['relation'] = $this->relation);
        !isset($this->boost) || ($normalize[self::IDENTIFIER][$this->field]['boost'] = $this->boost);

        /**
         * TODO: Validate empty
         */
        return $normalize;
    }

    /**
     * @param mixed $greaterThan
     * @return $this
     */
    public function setGreaterThan(mixed $greaterThan): self
    {
        $this->greaterThan = $greaterThan;

        return $this;
    }

    /**
     * @param mixed $greaterThanOrEqualTo
     * @return $this
     */
    public function setGreaterThanOrEqualTo(mixed $greaterThanOrEqualTo): self
    {
        $this->greaterThanOrEqualTo = $greaterThanOrEqualTo;

        return $this;
    }

    /**
     * @param mixed $lessThan
     * @return $this
     */
    public function setLessThan(mixed $lessThan): self
    {
        $this->lessThan = $lessThan;

        return $this;
    }

    /**
     * @param mixed $lessThanOrEqualTo
     * @return $this
     */
    public function setLessThanOrEqualTo(mixed $lessThanOrEqualTo): self
    {
        $this->lessThanOrEqualTo = $lessThanOrEqualTo;

        return $this;
    }

    /**
     * @param string $relation
     * @return $this
     */
    public function setRelation(string $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * @param string $timezone
     * @return $this
     */
    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * @param float $boost
     * @return $this
     */
    public function setBoost(float $boost): self
    {
        $this->boost = $boost;

        return $this;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }
}