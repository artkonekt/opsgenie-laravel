<?php

declare(strict_types=1);

/**
 * Contains the OpsGenieServiceProvider class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie;

use Illuminate\Support\ServiceProvider;
use Konekt\OpsGenie\Client\OpsGenieClient;

class OpsGenieServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();

        $this->app->singleton(OpsGenieClient::class, function ($app) {
            $config = $app['config']['services.opsgenie'] ?? [];

            return new OpsGenieClient(
                $config['auth_token'] ?? '',
                $this->obtainOpsGenieEndpoint($config),
            );
        });
    }

    private function obtainOpsGenieEndpoint(array $config): string
    {
        $result = $config['endpoint'] ?? null;
        if (null === $result) {
            $result = ($config['europe'] ?? false) ? 'https://api.eu.opsgenie.com/v2' : 'https://api.opsgenie.com/v2';
        }

        return $result;
    }
}
