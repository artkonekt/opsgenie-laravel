<?php

declare(strict_types=1);

/**
 * Contains the OpsGenieNotification interface.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Contracts;

interface OpsGenieNotification
{
    public function toOpsGenie($notifiable): OpsGenieCommand;
}
