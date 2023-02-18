<?php

namespace Log\Application\UseCase\Log\GetLogResponseHTTPCodeDistribution\DTO;

class GetLogResponseHTTPCodeDistributionOutputDTO
{
    public function __construct(
        public array $distribution = []
    )
    {

    }

}