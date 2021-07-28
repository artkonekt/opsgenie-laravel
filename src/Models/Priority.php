<?php

declare(strict_types=1);

/**
 * Contains the Priority class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-28
 *
 */

namespace Konekt\OpsGenie\Models;

use LogicException;

final class Priority
{
    public const __DEFAULT = self::P3;

    public const P1 = 'P1';
    public const P2 = 'P2';
    public const P3 = 'P3';
    public const P4 = 'P4';
    public const P5 = 'P5';

    private string $value;

    public function __construct(string $value = null)
    {
        if (null === $value) {
            $this->value = self::__DEFAULT;
        } elseif (!$this->isValid($value)) {
            throw new LogicException("Invalid OpsGenie priority `$value`");
        } else {
            $this->value = $value;
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function P1(): Priority
    {
        return new self(self::P1);
    }

    public static function P2(): Priority
    {
        return new self(self::P2);
    }

    public static function P3(): Priority
    {
        return new self(self::P3);
    }

    public static function P4(): Priority
    {
        return new self(self::P4);
    }

    public static function P5(): Priority
    {
        return new self(self::P5);
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private function isValid(string $value): bool
    {
        return in_array($value, [self::P1, self::P2, self::P3, self::P4, self::P5]);
    }
}
