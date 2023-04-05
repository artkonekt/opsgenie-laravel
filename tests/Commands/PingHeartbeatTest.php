<?php

declare(strict_types=1);

/**
 * Contains the PingHeartbeatTest class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Tests\Commands;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Konekt\OpsGenie\Client\OpsGenieClient;
use Konekt\OpsGenie\Commands\PingHeartbeat;
use Konekt\OpsGenie\Tests\TestCase;

class PingHeartbeatTest extends TestCase
{
    private OpsGenieClient $genie;

    protected function setUp(): void
    {
        parent::setUp();

        $this->genie = new OpsGenieClient('');

        Http::fake([
            'opsgenie.com/v2/heartbeats/*' => Http::response([
                'result' => 'PONG - Heartbeat received',
                'took' => 0,
                'requestId' => Str::uuid()->toString()
            ], 202)
        ]);
    }

    /** @test */
    public function it_can_be_executed()
    {
        $this->genie->execute(new PingHeartbeat('heartbeat-name'));

        Http::assertSent(function (Request $request) {
            return
                'post' === mb_strtolower($request->method()) &&
                'https://api.opsgenie.com/v2/heartbeats/heartbeat-name/ping' === $request->url()
            ;
        });
    }
}
