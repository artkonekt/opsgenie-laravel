<?php

declare(strict_types=1);

/**
 * Contains the TestCase class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Tests;

use Konekt\OpsGenie\OpsGenieServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [OpsGenieServiceProvider::class];
    }
}
