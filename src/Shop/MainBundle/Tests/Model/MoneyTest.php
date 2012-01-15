<?php

namespace Shop\MainBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Xi\Decimal\Decimal,
    Shop\MainBundle\Model\Money;

class MoneyTest extends TestCase
{    
    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * @test
     * @group model
     * @group money
     */
    public function smoke()
    {
        $this->assertInstanceOf('Shop\MainBundle\Model\Money', new Money(14.55));
        $this->assertInstanceOf('Shop\MainBundle\Model\Money', Money::create(14.55));
    }
    
    /**
     * @test
     * @group model
     * @group money
     */
    public function roundsMoneyUpCorrectly()
    {
        $this->assertEquals(
            Money::create('13.34'),
            Money::create('13.335')->round()
        );
    }
    
    /**
     * @test
     * @group model
     * @group money
     */
    public function roundsMoneyDownCorrectly()
    {
        $this->assertEquals(
            Money::create('13.33'),
            Money::create('13.334')->round()
        );
    }
    
    /**
     * @test
     * @group model
     * @group money
     */
    public function roundsIfCastedToString()
    {
        $this->assertEquals(
            '13.50',
            Money::create('13.495')->toString()
        );
    }
}
