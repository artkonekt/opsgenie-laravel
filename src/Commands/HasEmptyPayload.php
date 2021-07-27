<?php

declare(strict_types=1);

/**
 * Contains the HasEmptyPayload trait.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Commands;

trait HasEmptyPayload
{
    public function payload(): array
    {
        return [];
    }
}