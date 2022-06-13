<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\FunctionScore\Functions;

class FieldValueFactorFunction extends BaseFunction
{
    public const MODIFIER_TYPE_NONE = 'none';
    public const MODIFIER_TYPE_LOG = 'log';
    public const MODIFIER_TYPE_LOG1P = 'log1p';
    public const MODIFIER_TYPE_LOG2P = 'log2p';
    public const MODIFIER_TYPE_LN = 'ln';
    public const MODIFIER_TYPE_LN1P = 'ln1p';
    public const MODIFIER_TYPE_LN2P = 'ln2p';
    public const MODIFIER_TYPE_SQUARE = 'square';
    public const MODIFIER_TYPE_SQRT = 'sqrt';
    public const MODIFIER_TYPE_RECIPROCAL = 'reciprocal';

    /**
     * @var string
     */
    private string $field;

    /**
     * @var float
     */
    private float $factor;

    /**
     * @var string
     */
    private string $modifier;

    /**
     * @var int
     */
    private int $missing;

    /**
     * @param string $field
     */
    public function __construct(string $field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    protected function getIdentifier(): string
    {
        return 'field_value_factor';
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            $this->getIdentifier() => [
                'field' => $this->field
            ]
        ];
        !isset($this->factor) || ($normalize[$this->getIdentifier()]['factor'] = $this->factor);
        !isset($this->modifier) || ($normalize[$this->getIdentifier()]['modifier'] = $this->modifier);
        !isset($this->missing) || ($normalize[$this->getIdentifier()]['missing'] = $this->missing);
        !isset($this->weight) || ($normalize['weight'] = $this->weight);
        !isset($this->filter) || ($normalize['filter'] = $this->filter->normalize());

        return $normalize;
    }

    /**
     * @param float $factor
     * @return $this
     */
    public function setFactor(float $factor): self
    {
        $this->factor = $factor;

        return $this;
    }

    /**
     * @param string $modifier
     * @return $this
     */
    public function setModifier(string $modifier): self
    {
        $this->modifier = $modifier;

        return $this;
    }

    /**
     * @param int $missing
     * @return $this
     */
    public function setMissing(int $missing): self
    {
        $this->missing = $missing;

        return $this;
    }
}