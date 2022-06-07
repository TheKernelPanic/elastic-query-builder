<?php
declare(strict_types=1);

namespace ElasticQueryBuilder;

use ElasticQueryBuilder\Query\Query;
use ElasticQueryBuilder\Sort\Sort;
use function is_null;

class QueryBuilder
{
    /**
     * @var Query
     */
    private Query $query;

    /**
     * @var Sort[]
     */
    private array $sorts;

    /**
     * @var array
     */
    private array $built;

    /**
     * @var int|null
     */
    private ?int $size;

    private

    public function __construct()
    {
        $this->sorts = [];
        $this->size = null;
    }

    /**
     * @param Sort $sort
     * @return $this
     */
    public function sort(Sort $sort): self
    {
        $this->sorts[] = $sort;

        return $this;
    }

    /**
     * @param Query $query
     * @return $this
     */
    public function setQuery(Query $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return array
     */
    public function getDsl(): array
    {
        $dsl = [
            'query' => $this->query->normalize()
        ];
        if (count($this->sorts)) {
            $dsl['sort'] = [];
            foreach ($this->sorts as $sort) {
                $dsl['sort'][] = $sort->normalize();
            }
        }
        !is_null($this->size) || $dsl['size'] = $this->size;

        return $dsl;
    }

    /**
     * @param int|null $size
     * @return $this
     */
    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }
}