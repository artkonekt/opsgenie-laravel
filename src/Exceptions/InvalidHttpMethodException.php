<?php

declare(strict_types=1);

/**
 * Contains the InvalidHttpMethodException class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-27
 *
 */

namespace Konekt\OpsGenie\Exceptions;

use Konekt\OpsGenie\Contracts\OpsGenieCommand;
use LogicException;

class InvalidHttpMethodException extends LogicException
{
    public function __construct(OpsGenieCommand $command)
    {
        parent::__construct(
            sprintf(
                'Invalid HTTP method `%s` in command `%s`',
                $command->method(),
                get_class($command),
            )
        );
    }
}
