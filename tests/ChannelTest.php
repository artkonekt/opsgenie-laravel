<?php

declare(strict_types=1);

/**
 * Contains the ChannelTest class.
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
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Konekt\OpsGenie\Tests\Examples\OpsGenieTestNotification;

class ChannelTest extends TestCase
{
    /** @test */
    public function it_sends_a_notification()
    {
        $responseBody = [
            'result' => 'Request will be processed',
            'took' => 0.302,
            'requestId' => Str::uuid()->toString()
        ];

        Http::fake([
            'opsgenie.com/*' => Http::response($responseBody, 202)
        ]);

        Notification::sendNow(['asd'], new OpsGenieTestNotification('Yo! I am a message'));

        Http::assertSent(function (Request $request) {
            return
                'post' === mb_strtolower($request->method()) &&
                'Yo! I am a message' === $request['message']
            ;
        });
    }
}
