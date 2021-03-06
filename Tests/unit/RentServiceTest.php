<?php

namespace Tests\Unit;

use App\Helpers\DateHelper;
use App\Service\RentCalculator;
use PHPUnit\Framework\TestCase;

/**
 * @package Tests
 * @group unit
 * @group ready
 */
class RentServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /**
     * @dataProvider \Tests\unit\Provider\Service\DataProvider::provideProcessData
     */
    public function testProcessData($data, $expected)
    {
        $calculator = new RentCalculator();
        $result = $calculator->processData($data);
        $this->assertSame($expected, $result[1]);
    }
}
