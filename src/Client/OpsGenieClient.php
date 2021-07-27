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
use Konekt\OpsGenie\Contracts\OpsGenieCommand;
use Konekt\OpsGenie\Exceptions\InvalidHttpMethodException;
use Konekt\OpsGenie\Support\HttpMethod;

final class OpsGenieClient
{
    private string $authToken;

    private string $endpoint;

    public function __construct(string $authToken, string $endpoint = 'https://api.opsgenie.com/v2')
    {
        $this->authToken = $authToken;
        $this->endpoint = $this->sanitizeEndpoint($endpoint);
    }

    public function execute(OpsGenieCommand $command): Response
    {
        $this->validate($command);
        $method = $command->method();

        return $this->{$method}($command->path(), $command->payload());
    }

    public function post(string $path, array $payload): Response
    {
        return Http::withHeaders($this->headers())
            ->post($this->uri($path), $payload);
    }

    public function get(string $path, array $payload): Response
    {
        return Http::withHeaders($this->headers())
            ->get($this->uri($path), $payload);
    }

    public function delete(string $path, array $payload): Response
    {
        return Http::withHeaders($this->headers())
            ->delete($this->uri($path), $payload);
    }

    public function put(string $path, array $payload): Response
    {
        return Http::withHeaders($this->headers())
            ->put($this->uri($path), $payload);
    }

    public function patch(string $path, array $payload): Response
    {
        return Http::withHeaders($this->headers())
            ->patch($this->uri($path), $payload);
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

    private function validate(OpsGenieCommand $command): void
    {
        if (!HttpMethod::isValid($command->method())) {
            throw new InvalidHttpMethodException($command);
        }
    }
}
