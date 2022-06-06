<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Query\Joining;

use ElasticQueryBuilder\Query\Query;

class ParentIdQuery extends Query
{
    /**
     * Name of the child relationship mapped for the join field.
     * @var string
     */
    private string $type;

    /**
     * ID of the parent document. The query will return child documents
     * of this parent document.
     * @var string
     */
    private string $id;

    /**
     * Indicates whether to ignore an unmapped type and not return any
     * documents instead of an error.
     * @var bool
     */
    private bool $ignoreUnmapped;

    /**
     * @param string $type
     * @param string $id
     */
    public function __construct(string $type, string $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

    public function normalize(): array
    {
        $normalize = [
            'type' => $this->type,
            'id' => $this->id
        ];
        !isset($this->ignoreUnmapped) || ($normalize['ignore_unmapped'] = $this->ignoreUnmapped);

        return $normalize;
    }

    /**
     * @param bool $ignoreUnmapped
     * @return ParentIdQuery
     */
    public function setIgnoreUnmapped(bool $ignoreUnmapped): self
    {
        $this->ignoreUnmapped = $ignoreUnmapped;

        return $this;
    }
}