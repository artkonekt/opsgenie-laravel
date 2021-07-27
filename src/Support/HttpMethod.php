<?php

declare(strict_types=1);

/**
 * Contains the HttpMethod class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Support;

final class HttpMethod
{
    public const POST = 'post';
    public const GET = 'get';
    public const DELETE = 'delete';
    public const PUT = 'put';
    public const PATCH = 'patch';

    public static function isValid(string $method): bool
    {
        return in_array($method, [self::POST, self::GET, self::DELETE, self::PUT, self::PATCH]);
    }
}
