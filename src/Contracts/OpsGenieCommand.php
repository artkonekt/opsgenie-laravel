<?php

declare(strict_types=1);

/**
 * Contains the OpsGenieCommand interface.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Contracts;

interface OpsGenieCommand
{
    public function path(): string;

    public function method(): string;

    /** Either POST body or GET query parameters */
    public function payload(): array;
}