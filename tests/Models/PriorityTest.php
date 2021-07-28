<?php

declare(strict_types=1);

/**
 * Contains the PriorityTest class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-28
 *
 */

namespace Konekt\OpsGenie\Models\Tests;

use Konekt\OpsGenie\Models\Priority;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class PriorityTest extends PHPUnitTestCase
{
    /** @test */
    public function it_accepts_any_valid_value()
    {
        $p1 = new Priority('P1');
        $p2 = new Priority('P2');
        $p3 = new Priority('P3');
        $p4 = new Priority('P4');
        $p5 = new Priority('P5');

        $this->assertInstanceOf(Priority::class, $p1);
        $this->assertEquals('P1', $p1->value());

        $this->assertInstanceOf(Priority::class, $p2);
        $this->assertEquals('P2', $p2->value());

        $this->assertInstanceOf(Priority::class, $p3);
        $this->assertEquals('P3', $p3->value());

        $this->assertInstanceOf(Priority::class, $p4);
        $this->assertEquals('P4', $p4->value());

        $this->assertInstanceOf(Priority::class, $p5);
        $this->assertEquals('P5', $p5->value());
    }

    /** @test */
    public function it_uses_a_default_if_no_value_was_specified()
    {
        $priority = new Priority();
        $this->assertEquals(Priority::__DEFAULT, $priority->value());
    }

    /** @test */
    public function it_throws_an_exception_on_an_invalid_value()
    {
        $this->expectException(\LogicException::class);
        new Priority('asd');
    }

    /** @test */
    public function magic_constructors_work()
    {
        $p1 = Priority::P1();
        $p2 = Priority::P2();
        $p3 = Priority::P3();
        $p4 = Priority::P4();
        $p5 = Priority::P5();

        $this->assertInstanceOf(Priority::class, $p1);
        $this->assertEquals('P1', $p1->value());

        $this->assertInstanceOf(Priority::class, $p2);
        $this->assertEquals('P2', $p2->value());

        $this->assertInstanceOf(Priority::class, $p3);
        $this->assertEquals('P3', $p3->value());

        $this->assertInstanceOf(Priority::class, $p4);
        $this->assertEquals('P4', $p4->value());

        $this->assertInstanceOf(Priority::class, $p5);
        $this->assertEquals('P5', $p5->value());
    }

    /** @test */
    public function can_be_casted_to_string()
    {
        $p4 = Priority::P4();
        $p4s = (string) $p4;

        $this->assertIsString($p4s);
        $this->assertEquals('P4', $p4s);
    }
}
