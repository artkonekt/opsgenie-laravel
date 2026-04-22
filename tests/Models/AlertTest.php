<?php

declare(strict_types=1);

/**
 * Contains the AlertTest class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-28
 *
 */

namespace Konekt\OpsGenie\Tests\Models;

use Konekt\OpsGenie\Models\Alert;
use Konekt\OpsGenie\Models\Priority;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class AlertTest extends PHPUnitTestCase
{
    #[Test]
    public function it_can_be_instantiated_with_a_message_only()
    {
        $alert = new Alert('We have a problem');

        $this->assertEquals('We have a problem', $alert->message);
    }

    #[Test]
    public function it_has_a_default_priority_if_unspecified()
    {
        $alert = new Alert('');

        $this->assertInstanceOf(Priority::class, $alert->priority);
        $this->assertEquals(Priority::__DEFAULT, $alert->priority->value());
    }

    #[Test]
    public function it_can_be_convert_to_an_array()
    {
        $alert = new Alert('Boo Botsie');

        $array = $alert->toArray();
        $this->assertIsArray($array);
        $this->assertEquals('Boo Botsie', $array['message']);
        $this->assertEquals(Priority::__DEFAULT, $array['priority']);
    }

    #[Test]
    public function attributes_can_be_set_in_the_constructor()
    {
        $alert = new Alert('PJ Masks', [
            'alias' => 'SQL Error',
            'description' => 'Error at SELECT * from Catsville',
            'source' => 'MySQL PRI',
            'user' => 'Giovanni Gatto',
            'note' => 'Contact Mr. Fritz Teufel'
        ]);

        $this->assertEquals('SQL Error', $alert->alias);
        $this->assertEquals('Error at SELECT * from Catsville', $alert->description);
        $this->assertEquals('MySQL PRI', $alert->source);
        $this->assertEquals('Giovanni Gatto', $alert->user);
        $this->assertEquals('Contact Mr. Fritz Teufel', $alert->note);
    }

    #[Test]
    public function priority_can_be_set_in_the_constructor()
    {
        $alert1 = new Alert('', ['priority' => 'P1']);
        $alert2 = new Alert('', ['priority' => Priority::P2()]);

        $this->assertEquals('P1', $alert1->priority->value());
        $this->assertEquals('P2', $alert2->priority->value());
    }
}
