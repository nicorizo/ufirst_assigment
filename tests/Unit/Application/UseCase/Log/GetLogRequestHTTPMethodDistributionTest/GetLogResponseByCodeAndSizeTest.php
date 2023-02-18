<?php

namespace Unit\Application\UseCase\Log\GetLogRequestHTTPMethodDistributionTest;

use Log\Application\UseCase\Log\GetLogRequestHTTPMethodDistribution\DTO\GetLogRequestHTTPMethodDistributionOutputDTO;
use Log\Application\UseCase\Log\GetLogRequestHTTPMethodDistribution\GetLogRequestHTTPMethodDistribution;
use Log\Application\UseCase\Log\GetLogRequestPerMinute\DTO\GetLogRequestPerMinuteOutputDTO;
use Log\Application\UseCase\Log\GetLogResponseByCodeAndSize\DTO\GetLogResponseByCodeAndSizeInputDTO;
use Log\Application\UseCase\Log\GetLogResponseByCodeAndSize\DTO\GetLogResponseByCodeAndSizeOutputDTO;
use Log\Application\UseCase\Log\GetLogResponseByCodeAndSize\GetLogResponseByCodeAndSize;
use Log\Domain\Repository\LogRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetLogResponseByCodeAndSizeTest extends TestCase
{
    private LogRepository|MockObject $logRepository;
    private GetLogResponseByCodeAndSize $useCase;

    public function setUp(): void
    {
        $this->logRepository = $this->createMock(LogRepository::class);
        $this->useCase = new GetLogResponseByCodeAndSize($this->logRepository);
    }

    public function testGetLogRequestHTTPMethodDistribution(): void
    {

        $this->logRepository
            ->expects($this->once())
            ->method('findAll')
        ;

        $inputDTO = GetLogResponseByCodeAndSizeInputDTO::create(200, 1000);
        $responseDto = $this->useCase->handle($inputDTO);

        self::assertInstanceOf(GetLogResponseByCodeAndSizeOutputDTO::class, $responseDto);
    }

}