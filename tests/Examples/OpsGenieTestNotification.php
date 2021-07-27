<?php

declare(strict_types=1);

/**
 * Contains the OpsGenieTestNotification class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Tests\Examples;

use Illuminate\Notifications\Notification;
use Konekt\OpsGenie\Commands\CreateAlert;
use Konekt\OpsGenie\Contracts\OpsGenieCommand;
use Konekt\OpsGenie\Contracts\OpsGenieNotification;
use Konekt\OpsGenie\Notification\OpsGenieChannel;

class OpsGenieTestNotification extends Notification implements OpsGenieNotification
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return [OpsGenieChannel::class];
    }

    public function toOpsGenie($notifiable): OpsGenieCommand
    {
        return new CreateAlert($this->message);
    }
}
