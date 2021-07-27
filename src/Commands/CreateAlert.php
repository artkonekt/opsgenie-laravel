<?php

declare(strict_types=1);

/**
 * Contains the CreateAlert class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Commands;

use Konekt\OpsGenie\Contracts\OpsGenieCommand;

final class CreateAlert extends BasePostCommand implements OpsGenieCommand
{
    protected string $path = '/alerts';

    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function payload(): array
    {
        return ['message' => $this->message];
    }
}
