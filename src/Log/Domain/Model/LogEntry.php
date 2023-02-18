<?php

namespace Log\Domain\Model;


class LogEntry
{



    public function __construct(
        private string $host,
        private \DateTime $datetime,
        private string $requestMethod,
        private string $requestUrl,
        private string $requestProtocol,
        private string $requestProtocolVersion,
        private int    $responseCode,
        private int    $responseSize,
    )
    {
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime(): \DateTime
    {
        return $this->datetime;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $this->requestMethod;
    }

    /**
     * @return string
     */
    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    /**
     * @return string
     */
    public function getRequestProtocol(): string
    {
        return $this->requestProtocol;
    }

    /**
     * @return string
     */
    public function getRequestProtocolVersion(): string
    {
        return $this->requestProtocolVersion;
    }

    /**
     * @return int
     */
    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    /**
     * @return int
     */
    public function getResponseSize(): int
    {
        return $this->responseSize;
    }



}