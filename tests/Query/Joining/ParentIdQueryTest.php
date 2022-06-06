<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Tests\Query\Joining;

use ElasticQueryBuilder\Query\Joining\ParentIdQuery;
use PHPUnit\Framework\TestCase;

class ParentIdQueryTest extends TestCase
{
    /**
     * @covers \ElasticQueryBuilder\Query\Joining\ParentIdQuery
     * @return void
     */
    public function testNormalize(): void
    {
        $query = new ParentIdQuery(
            'foo',
            '1'
        );
        $normalize = $query->normalize();
        $this->assertArrayHasKey('type', $normalize['parent_id']);
        $this->assertArrayHasKey('id', $normalize['parent_id']);
        $this->assertArrayNotHasKey('ignore_unmapped', $normalize['parent_id']);

        $query->setIgnoreUnmapped(true);
        $normalize = $query->normalize();
        $this->assertArrayHasKey('ignore_unmapped', $normalize['parent_id']);
    }
}