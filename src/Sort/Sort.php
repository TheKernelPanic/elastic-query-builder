<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Sort;

use ElasticQueryBuilder\Normalize\NormalizerInterface;

abstract class Sort implements NormalizerInterface
{
    public const ORDER_ASC = 'asc';
    public const ORDER_DESC = 'desc';

    public const MODE_MIN = 'min';
    public const MODE_MAX = 'max';
    public const MODE_SUM = 'sum';
    public const MODE_AVG = 'avg';
    public const MODE_MEDIAN = 'median';

    /**
     * @var string
     */
    protected string $order;

    /**
     * @var string
     */
    protected string $mode;

    /**
     * @param string $order
     * @return Sort
     */
    public function setOrder(string $order): self
    {
        /**
         * TODO: Validate
         */
        $this->order = $order;

        return $this;
    }

    /**
     * @param string $mode
     * @return $this
     */
    public function setMode(string $mode): self
    {
        /**
         * TODO: Validate
         */
        $this->mode = $mode;

        return $this;
    }
}