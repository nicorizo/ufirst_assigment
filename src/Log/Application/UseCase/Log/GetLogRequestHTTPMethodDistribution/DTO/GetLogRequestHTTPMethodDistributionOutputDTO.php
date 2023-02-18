<?php

namespace Log\Application\UseCase\Log\GetLogRequestHTTPMethodDistribution\DTO;

class GetLogRequestHTTPMethodDistributionOutputDTO
{
    public function __construct(
        public array $distribution = []
    )
    {
    }

}