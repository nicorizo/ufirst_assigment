<?php

namespace Log\Domain\Exception;

class ResourceNotFoundException extends \DomainException
{
    public static function createFromClassAndId(string $class, string $id): self
    {
        return new static(sprintf('Resource of type [%s] with id [%s] not found', $class, $id));
    }

    public static function createFromClassAndField(string $class, string $field, mixed $value): self
    {
        return new static(sprintf('Resource of type [%s] with [%s] [%s] not found', $class, $field, $value));
    }

}