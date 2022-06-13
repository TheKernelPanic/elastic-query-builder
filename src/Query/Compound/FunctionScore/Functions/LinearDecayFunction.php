<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Compound\FunctionScore\Functions;

class LinearDecayFunction extends DecayFunction
{
    /**
     * @return string
     */
    protected function getIdentifier(): string
    {
        return 'linear';
    }
}