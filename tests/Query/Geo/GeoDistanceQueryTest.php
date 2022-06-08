<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Tests\Query\Geo;

use ElasticQueryBuilder\Query\Geo\DistanceQuery;
use ElasticQueryBuilder\Types\GeoCoordinates;
use PHPUnit\Framework\TestCase;

class DistanceQueryTest extends TestCase
{
    /**
     * @covers \ElasticQueryBuilder\Query\Geo\DistanceQuery
     * @return void
     */
    public function testNormalize(): void
    {
        $query = new DistanceQuery(
            'foo',
            '1000m',
            new GeoCoordinates(
                40,
                -70
            )
        );
        $normalize = $query->normalize();

        $this->assertArrayHasKey('foo', $normalize['geo_distance']);
        $this->assertArrayHasKey('distance', $normalize['geo_distance']);
        $this->assertEquals(40, $normalize['geo_distance']['foo']['lat']);
        $this->assertEquals(-70, $normalize['geo_distance']['foo']['lon']);
    }
}