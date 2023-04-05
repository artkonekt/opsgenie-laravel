<?php

declare(strict_types=1);

/**
 * Contains the OpsGenieClientTest class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Tests;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Konekt\OpsGenie\Client\OpsGenieClient;

class OpsGenieClientTest extends TestCase
{
    /** @test */
    public function it_sends_a_proper_create_alert_request()
    {
        $responseBody = [
            'result' => 'Request will be processed',
            'took' => 0.302,
            'requestId' => Str::uuid()->toString()
        ];

        Http::fake([
            'opsgenie.com/*' => Http::response($responseBody, 202)
        ]);

        (new OpsGenieClient('someAuthKey'))->post('/alerts', ['message' => 'Test alert']);

        Http::assertSent(function (Request $request) {
            return
                'post' === mb_strtolower($request->method()) &&
                'https://api.opsgenie.com/v2/alerts' === $request->url() &&
                'Test alert' === $request['message'] &&
                $request->hasHeader('Authorization') &&
                'GenieKey someAuthKey' === $request->header('Authorization')[0]
            ;
        });
    }

    /** @test */
    public function the_endpoint_can_be_changed()
    {
        $responseBody = [
            'result' => 'Request will be processed',
            'took' => 0.302,
            'requestId' => Str::uuid()->toString()
        ];

        Http::fake([
            'opsgenie.com/*' => Http::response($responseBody, 202)
        ]);

        (new OpsGenieClient('', 'https://api.eu.opsgenie.com/v2'))->post('/alerts', ['message' => 'Test alert']);

        Http::assertSent(function (Request $request) {
            return 'https://api.eu.opsgenie.com/v2/alerts' === $request->url();
        });
    }
}
