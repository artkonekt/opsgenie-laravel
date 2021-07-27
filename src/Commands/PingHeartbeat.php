<?php

declare(strict_types=1);

/**
 * Contains the PingHeartbeat class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Commands;

use Konekt\OpsGenie\Contracts\OpsGenieCommand;

final class PingHeartbeat extends BasePostCommand implements OpsGenieCommand
{
    use HasEmptyPayload;

    private string $heartbeatName;

    public function __construct(string $heartbeatName)
    {
        $this->heartbeatName = $heartbeatName;
    }

    public function path(): string
    {
        return '/heartbeats/' . $this->heartbeatName . '/ping';
    }
}
