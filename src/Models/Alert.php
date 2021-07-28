<?php

declare(strict_types=1);

/**
 * Contains the Alert class.
 *
 * @copyright   Copyright (c) 2021 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2021-07-28
 *
 */

namespace Konekt\OpsGenie\Models;

final class Alert
{
    private const STRING_ATTRIBUTES = ['alias', 'description', 'source', 'user', 'note'];

    public string $message;

    public ?string $alias = null;

    public ?string $description = null;

    public ?string $source = null;

    public ?string $user = null;

    public ?string $note = null;

    public Priority $priority;

    public function __construct(string $message, array $attributes = [])
    {
        $this->message = $message;
        $this->priority = $this->obtainPriority($attributes['priority'] ?? null);

        foreach (self::STRING_ATTRIBUTES as $attribute) {
            if (array_key_exists($attribute, $attributes)) {
                $this->{$attribute} = (string) $attributes[$attribute];
            }
        }
    }

    public function toArray(): array
    {
        $result = [
            'message' => $this->message,
            'priority' => $this->priority->value(),
        ];

        foreach (self::STRING_ATTRIBUTES as $attribute) {
            if (null !== $this->{$attribute}) {
                $result[$attribute] = $this->{$attribute};
            }
        }

        return $result;
    }

    private function obtainPriority($priority): Priority
    {
        if ($priority instanceof Priority) {
            return $priority;
        }

        return new Priority($priority);
    }
}
