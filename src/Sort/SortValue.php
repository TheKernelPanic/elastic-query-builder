<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Sort;

class SortValue extends Sort
{
    /**
     * @var string
     */
    private string $field;

    /**
     * @var string
     */
    private string $format;

    /**
     * @param string $field
     * @param string $order
     */
    public function __construct(string $field, string $order)
    {
        $this->field = $field;
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function normalize(): array
    {
        $normalize = [
            $this->field => [
                'order' => $this->order
            ]
        ];
        !isset($this->mode) || ($normalize[$this->field]['mode'] = $this->mode);
        !isset($this->format) || ($normalize[$this->field]['format'] = $this->format);

        return $normalize;
    }
}