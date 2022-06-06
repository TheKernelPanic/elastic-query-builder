<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Sort;

use ElasticQueryBuilder\Query\Joining\NestedQuery;

class SortNested extends Sort
{
    /**
     * @var string
     */
    private string $path;

    /**
     * TODO: Filter
     */

    /**
     * @var NestedQuery
     */
    private NestedQuery $nestedQuery;

    /**
     * @var int
     */
    private int $maxChildren;

    /**
     * @param string $path
     * @param NestedQuery $nestedQuery
     * @param string $order
     */
    public function __construct(string $path, NestedQuery $nestedQuery, string $order)
    {
        $this->path = $path;
        $this->nestedQuery = $nestedQuery;
        /**
         * TODO: Validate order
         */
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            $this->path => array_merge_recursive(
                [
                    'order' => $this->order,
                ],
                $this->nestedQuery->normalize()
            )
        ];
        !isset($this->mode) || ($normalize[$this->path]['mode'] = $this->mode);

        return $normalize;
    }
}