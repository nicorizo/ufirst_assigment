<?php

namespace Functional\Log\Adapter\Framework\Http\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class LogGetRequestPerMinuteControllerTest extends WebTestCase
{
    const ENDPOINT = '/log_get_request_per_minute';

    public function testGetRequestPerMinute()
    {
        //request the page
        $this->client->request(
            Request::METHOD_GET,
            self::ENDPOINT
        );

        $this->assertResponseIsSuccessful();
    }

    protected ?KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = $this->createClient();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }

}