<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Tests\Value;

use ElasticQueryBuilder\Value\TimeUnit;
use PHPUnit\Framework\TestCase;

class TimeUnitTest extends TestCase
{
    /**
     * @covers \ElasticQueryBuilder\Value\TimeUnit::minutes
     * @return void
     */
    public function testMinutes(): void
    {
        $this->assertEquals('25m', TimeUnit::minutes(25));
    }
}