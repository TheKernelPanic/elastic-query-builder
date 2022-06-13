<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\FunctionScore\Functions;

class ExponentialDecayFunction extends DecayFunction
{
    /**
     * @return string
     */
    protected function getIdentifier(): string
    {
        return 'exp';
    }
}