<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\FunctionScore\Functions;

class RandomFunction extends BaseFunction
{
    /**
     * @var int
     */
    private int $seed;

    /**
     * @var string
     */
    private string $field;

    /**
     * @return string
     */
    protected function getIdentifier(): string
    {
        return 'random_score';
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            $this->getIdentifier() => []
        ];
        !isset($this->seed) || ($normalize[$this->getIdentifier()]['seed'] = $this->seed);
        !isset($this->field) || ($normalize[$this->getIdentifier()]['field'] = $this->field);
        !isset($this->weight) || ($normalize['weight'] = $this->weight);
        !isset($this->filter) || ($normalize['filter'] = $this->filter->normalize());

        return $normalize;
    }

    /**
     * @param int $seed
     * @return $this
     */
    public function setSeed(int $seed): self
    {
        $this->seed = $seed;

        return $this;
    }

    /**
     * @param string $field
     * @return $this
     */
    public function setField(string $field): self
    {
        $this->field = $field;

        return $this;
    }
}