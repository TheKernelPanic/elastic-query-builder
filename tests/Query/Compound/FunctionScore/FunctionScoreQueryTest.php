<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Tests\Query\Compound\FunctionScore;

use ElasticQueryBuilder\Query\Compound\FunctionScore\Functions\BaseFunction;
use ElasticQueryBuilder\Query\Compound\FunctionScore\FunctionScoreQuery;
use ElasticQueryBuilder\Query\Query;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class FunctionScoreQueryTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @covers \ElasticQueryBuilder\Query\Compound\FunctionScore\FunctionScoreQuery
     * @return void
     */
    public function testNormalize(): void
    {
        $stubQuery = $this->prophesize(Query::class);
        $stubQuery
            ->normalize()
            ->shouldBeCalled()
            ->willReturn(['foo' => true]);

        $stubFunction = $this->prophesize(BaseFunction::class);
        $stubFunction
            ->normalize()
            ->willReturn(['foo' => true]);

        $query = new FunctionScoreQuery(
            $stubQuery->reveal()
        );
        $query
            ->addFunction($stubFunction->reveal())
            ->setBoost($boostVal = '5')
            ->setScoreMode(FunctionScoreQuery::SCORE_MODE_FIRST)
            ->setBoostMode(FunctionScoreQuery::BOOST_MODE_AVG)
            ->setMaxBoost($maxBoostVal = 40)
            ->setMinScore($minScoreVal = 40);

        $dsl = $query->normalize();

        $this->assertArrayHasKey('query', $dsl['function_score']);
        $this->assertArrayHasKey('foo', $dsl['function_score']);
        $this->assertEquals($boostVal, $dsl['function_score']['boost']);
        $this->assertEquals(FunctionScoreQuery::SCORE_MODE_FIRST, $dsl['function_score']['score_mode']);
        $this->assertEquals(FunctionScoreQuery::BOOST_MODE_AVG, $dsl['function_score']['boost_mode']);
        $this->assertEquals($maxBoostVal, $dsl['function_score']['max_boost']);
        $this->assertEquals($minScoreVal, $dsl['function_score']['min_score']);

        $query
            ->addFunction($stubFunction->reveal());

        $dsl = $query->normalize();

        $this->assertCount(2, $dsl['function_score']['functions']);
        $this->assertArrayNotHasKey('foo', $dsl['function_score']);
    }
}