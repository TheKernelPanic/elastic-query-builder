<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\FunctionScore\Functions;

class ScriptFunction extends BaseFunction
{
    /**
     * @var string
     */
    private string $source;

    /**
     * @var array
     */
    private array $params;

    /**
     * @param string $source
     */
    public function __construct(string $source)
    {
        $this->source = $source;
        $this->params = [];
    }

    /**
     * TODO: Value type
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addParam(string $key, string $value): self
    {
        $this->params[$key] = $value;

        return $this;
    }

    /**
     * @return string
     */
    protected function getIdentifier(): string
    {
        return 'script_score';
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            $this->getIdentifier() => [
                'script' => [
                    'source' => $this->source
                ]
            ]
        ];
        !count($this->params) || ($normalize[$this->getIdentifier()]['script']['params'] = $this->params);
        !isset($this->weight) || ($normalize['weight'] = $this->weight);
        !isset($this->filter) || ($normalize['filter'] = $this->filter->normalize());

        return $normalize;
    }
}