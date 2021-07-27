<?php

declare(strict_types=1);

/**
 * Contains the BaseCommand class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Commands;

abstract class BaseCommand
{
    protected string $path; // Set the value in the concrete class

    public function path(): string
    {
        return $this->path;
    }
}
