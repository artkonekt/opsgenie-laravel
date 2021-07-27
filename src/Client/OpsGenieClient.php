<?php

declare(strict_types=1);

/**
 * Contains the OpsGenieClient class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Client;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

final class OpsGenieClient
{
    private string $authToken;

    private string $endpoint;

    public function __construct(string $authToken, string $endpoint = 'https://api.opsgenie.com/v2')
    {
        $this->authToken = $authToken;
        $this->endpoint = $this->sanitizeEndpoint($endpoint);
    }

    public function post(string $path, array $payload): Response
    {
        return Http::withHeaders($this->headers())
            ->post($this->uri($path), $payload);
    }

    private function headers(): array
    {
        return [
            'Authorization' => 'GenieKey ' . $this->authToken,
            'Content-Type' => 'application/json',
        ];
    }

    private function uri(string $forPath): string
    {
        if (!Str::startsWith($forPath, '/')) {
            $forPath = "/$forPath";
        }

        return $this->endpoint . $forPath;
    }

    private function sanitizeEndpoint(string $endpoint): string
    {
        $result = Str::endsWith($endpoint, '/') ? Str::replaceLast('/', '', $endpoint) : $endpoint;

        return !Str::endsWith($result, '/v2') ? $result . '/v2' : $result;
    }
}
