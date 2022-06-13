<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\FunctionScore\Functions;

abstract class DecayFunction extends BaseFunction
{
    public const MULTI_VALUE_MODE_MIN = 'min';
    public const MULTI_VALUE_MODE_MAX = 'max';
    public const MULTI_VALUE_MODE_AVG = 'avg';
    public const MULTI_VALUE_MODE_SUM = 'sum';

    /**
     * @var string
     */
    protected string $field;

    /**
     * @var string
     */
    protected string $scale;

    /**
     * @var float
     */
    protected float $decay;

    /**
     * @var string
     */
    protected string $origin;

    /**
     * @var int
     */
    protected int $offset;

    /**
     * @var string
     */
    protected string $multiValueMode;

    /**
     * @param string $field
     * @param string $scale
     */
    public function __construct(string $field, string $scale)
    {
        $this->field = $field;
        $this->scale = $scale;
    }

    public function normalize(): array
    {
        $normalize = [
            $this->getIdentifier() => [
                'field' => [
                    'scale' => $this->scale
                ]
            ]
        ];
        !isset($this->decay) || ($normalize[$this->getIdentifier()]['field']['decay'] = $this->decay);
        !isset($this->origin) || ($normalize[$this->getIdentifier()]['field']['origin'] = $this->origin);
        !isset($this->offset) || ($normalize[$this->getIdentifier()]['field']['offset'] = $this->offset);
        !isset($this->multiValueMode) || ($normalize[$this->getIdentifier()]['multi_value_mode'] = $this->multiValueMode);
        !isset($this->weight) || ($normalize['weight'] = $this->weight);
        !isset($this->filter) || ($normalize['filter'] = $this->filter->normalize());

        return $normalize;
    }
}