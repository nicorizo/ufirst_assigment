<?php

namespace Log\Application\UseCase\Log\GetLogRequestPerMinute\DTO;

class GetLogRequestPerMinuteOutputDTO
{
    public function __construct(
        public array $distribution = []
    )
    {
    }

}