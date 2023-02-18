<?php

namespace Unit\Adapter\Framework\Data\Plain\Repository;

use Log\Adapter\Framework\Data\Plain\Repository\PlainLogRepository;
use Log\Domain\Model\LogEntry;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PlainLogRepositoryTest extends TestCase
{
    const TEXT_LOG_ENTRY = '141.243.1.172 [29:23:53:25] "GET /Software.html HTTP/1.0" 200 1497';
    public PlainLogRepository|MockObject $plainLogRepository;

    public function testMapTextEntryToLogEntry(): void
    {
        $this->plainLogRepository = $this->getMockBuilder(PlainLogRepository::class)
            ->disableOriginalConstructor()->getMock();

        $reflection = new \ReflectionClass(PlainLogRepository::class);
        $method = $reflection->getMethod('mapTextEntryToLogEntry');
        $method->setAccessible(true);

        $logResult = $method->invokeArgs($this->plainLogRepository, [self::TEXT_LOG_ENTRY]);

        $this->assertInstanceOf(LogEntry::class, $logResult);

        $this->assertIsString($logResult->getHost());

        $this->assertEquals('141.243.1.172', $logResult->getHost());
        $this->assertEquals('23:53:25', $logResult->getDatetime()->format('H:i:s'));
        $this->assertEquals('GET', $logResult->getRequestMethod());
        $this->assertEquals('/Software.html', $logResult->getRequestUrl());
        $this->assertEquals('HTTP', $logResult->getRequestProtocol());
        $this->assertEquals('1.0', $logResult->getRequestProtocolVersion());
        $this->assertEquals('200', $logResult->getResponseCode());
        $this->assertEquals('1497', $logResult->getResponseSize());
    }

}