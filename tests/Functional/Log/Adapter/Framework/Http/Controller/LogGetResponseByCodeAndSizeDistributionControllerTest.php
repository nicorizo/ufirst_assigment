<?php

namespace Functional\Log\Adapter\Framework\Http\Controller;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class LogGetResponseByCodeAndSizeDistributionControllerTest extends WebTestCase
{
    const ENDPOINT = '/log_get_response_by_code_and_size_distribution';

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