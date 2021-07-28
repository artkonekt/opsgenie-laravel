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
use Konekt\OpsGenie\Models\Alert;

final class CreateAlert extends BasePostCommand implements OpsGenieCommand
{
    protected string $path = '/alerts';

    private Alert $alert;

    public function __construct(Alert $alert)
    {
        $this->alert = $alert;
    }

    public static function withMessage(string $message)
    {
        return new self(new Alert($message));
    }

    public function payload(): array
    {
        return $this->alert->toArray();
    }
}
