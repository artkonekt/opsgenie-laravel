<?php

declare(strict_types=1);

/**
 * Contains the OpsGenieChannel class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Notification;

use Illuminate\Notifications\Notification;
use Konekt\OpsGenie\Client\OpsGenieClient;

final class OpsGenieChannel
{
    private OpsGenieClient $genieClient;

    public function __construct(OpsGenieClient $genieClient)
    {
        $this->genieClient = $genieClient;
    }

    public function send($notifiable, Notification $notification)
    {
        $payload = $notification->toOpsGenie($notifiable);

        $this->genieClient->post('/alerts', $payload);
    }
}
