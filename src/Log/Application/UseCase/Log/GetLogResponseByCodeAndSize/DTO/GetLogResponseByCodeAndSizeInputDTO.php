<?php

namespace Log\Application\UseCase\Log\GetLogResponseByCodeAndSize\DTO;

class GetLogResponseByCodeAndSizeInputDTO
{
    private function __construct(
        public readonly int $code,
        public readonly int $size
    )
    {
    }


    public static function create(int $code, int $size): self
    {
        return new static($code, $size);
    }

}