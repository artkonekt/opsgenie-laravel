<?php

declare(strict_types=1);

/**
 * Contains the BasePostCommand class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Commands;

use Konekt\OpsGenie\Support\HttpMethod;

abstract class BasePostCommand extends BaseCommand
{
    public function method(): string
    {
        return HttpMethod::POST;
    }
}
