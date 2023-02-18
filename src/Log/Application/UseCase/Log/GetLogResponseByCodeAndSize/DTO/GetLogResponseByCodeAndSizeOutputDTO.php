<?php

namespace Log\Application\UseCase\Log\GetLogResponseByCodeAndSize\DTO;

class GetLogResponseByCodeAndSizeOutputDTO
{
    public function __construct(
        public array $distribution = []
    )
    {

    }

}