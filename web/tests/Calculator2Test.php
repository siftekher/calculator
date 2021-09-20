<?php
use PHPUnit\Framework\TestCase;

final class Calcultor1Test extends TestCase
{
    private $calculatorObj;
    public function setUp(): void
    {
        $expression = '[1+((4*4/2)';
        $this->calculatorObj = new Calculator($params);
    }

    public function testValue()
    {
        $this->assertSame(9, $this->calculatorObj->evaluteExpression());
    }

    public function testCurrentX()
    {
        $this->assertSame(10, $this->calculatorObj->getExpressionLength());
    }

}

