<?php

namespace Unit\Application\UseCase\Log\CreateJsonDataFile;

use Log\Adapter\Framework\Data\Json\Repository\JsonLogRepository;
use Log\Adapter\Framework\Data\Plain\Repository\PlainLogRepository;
use Log\Application\UseCase\Log\CreateJsonDataFile\CreateJsonDataFile;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateJsonDataFileTest extends TestCase
{
    private PlainLogRepository|MockObject $plainLogRepository;
    private JsonLogRepository|MockObject $jsonLogRepository;
    private CreateJsonDataFile $useCase;


    public function testCreateJsonDataFile(): void
    {
        $this->plainLogRepository = $this->getMockBuilder(PlainLogRepository::class)
            ->disableOriginalConstructor()->getMock();
        $this->jsonLogRepository = $this->getMockBuilder(JsonLogRepository::class)
            ->disableOriginalConstructor()->getMock();
        $this->useCase = new CreateJsonDataFile($this->plainLogRepository, $this->jsonLogRepository);

        $this->plainLogRepository
            ->expects($this->exactly(1))
            ->method('findAllLazy')
            ;
        $this->jsonLogRepository
            ->expects($this->exactly(1))
            ->method('flush');

        $this->useCase->handle();

    }


}