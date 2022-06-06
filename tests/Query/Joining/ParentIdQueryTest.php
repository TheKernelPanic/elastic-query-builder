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
        $this->assertArrayHasKey('type', $normalize);
        $this->assertArrayHasKey('id', $normalize);
        $this->assertArrayNotHasKey('ignore_unmapped', $normalize);

        $query->setIgnoreUnmapped(true);
        $normalize = $query->normalize();
        $this->assertArrayHasKey('ignore_unmapped', $normalize);
    }
}