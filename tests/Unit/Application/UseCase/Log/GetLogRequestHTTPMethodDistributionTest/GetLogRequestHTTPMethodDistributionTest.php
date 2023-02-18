<?php

namespace Unit\Application\UseCase\Log\GetLogRequestHTTPMethodDistributionTest;

use Log\Application\UseCase\Log\GetLogRequestHTTPMethodDistribution\DTO\GetLogRequestHTTPMethodDistributionOutputDTO;
use Log\Application\UseCase\Log\GetLogRequestHTTPMethodDistribution\GetLogRequestHTTPMethodDistribution;
use Log\Domain\Repository\LogRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetLogRequestHTTPMethodDistributionTest extends TestCase
{
    private LogRepository|MockObject $logRepository;
    private GetLogRequestHTTPMethodDistribution $useCase;

    public function setUp(): void
    {
        $this->logRepository = $this->createMock(LogRepository::class);
        $this->useCase = new GetLogRequestHTTPMethodDistribution($this->logRepository);
    }

    public function testGetLogRequestHTTPMethodDistribution(): void
    {
        $this->logRepository
            ->expects($this->once())
            ->method('findAll');

        $responseDto = $this->useCase->handle();

        self::assertInstanceOf(GetLogRequestHTTPMethodDistributionOutputDTO::class, $responseDto);
    }

}