<?php
/**
 * @author  Rizart Dokollari <r.dokollari@gmail.com>
 * @since   12/24/17
 */

namespace Tests\Email;

use ElasticEmail\Client;
use ElasticEmail\ElasticEmail;
use ElasticEmail\Email\Send;
use Tests\TestCase;

class SendTest extends TestCase
{
    /** @test */
    public function appends_api_key()
    {
        $this->appendsApiKey(Send::class);
    }

    /** @test */
    public function send_an_email()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../../');

        $dotenv->load();

        $client = new Client(getenv('ELASTIC_EMAIL_API_KEY'));

        $send = new Send($client);

        $response = $send->handle([
            'to'      => 'r.dokollari@gmail.com',
            'from'    => 'r.dokollari@gmail.com',
            'subject' => subject(__FUNCTION__),
        ]);

        $this->assertTrue($response->wasSuccessful());

        $this->assertEquals(200, $response->getStatusCode());
    }

    /** @test */
    public function forward_params_as_http_query()
    {
        $client = $this->getMockBuilder(Client::class)
            ->setConstructorArgs(['api-key'])
            ->getMock();

        $params = ['any-parameter' => 'any-parameter-value'];

        $expectedParams = ['form_params' => $params];

        $client->expects($this->once())
            ->method('request')
            ->with('POST', Send::URI, $expectedParams);

        /** @var Client $client */

        $send = new Send($client);

        $send->handle($params);
    }

    /** @test */
    public function use_multipart_option_to_send_files()
    {
        $client = $this->getMockBuilder(Client::class)
            ->setConstructorArgs(['api-key'])
            ->getMock();

        $params = [$name = 'any-parameter' => $content = 'any-parameter-value'];

        $expectedParams = ['multipart' => [
            [
                'name'     => $name,
                'contents' => $content
            ]
        ]];

        $client->expects($this->once())
            ->method('request')
            ->with('POST', Send::URI, $expectedParams);

        /** @var Client $client */

        $send = new Send($client);

        $send->handle($params, true);
    }
}