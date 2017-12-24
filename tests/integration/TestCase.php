<?php
/**
 * @author  Rizart Dokollari <r.dokollari@gmail.com>
 * @since   12/24/17
 */

namespace Tests\integration;

use ElasticEmail\ElasticEmail;
use ElasticEmail\V2\Responses\Email\EmailResponse;
use Faker\Factory;

class TestCase extends \Tests\TestCase
{
    const APP_ENV = 'APP_ENV';
    const API_KEY = 'ELASTIC_EMAIL_API_KEY';
    const INTEGRATION_SERVER = 'integration_server';

    /** @var  ElasticEmail */
    protected $elasticEmail;

    /** @var  array */
    protected $emailData;

    /** @var  Factory */
    protected $faker;

    /** @var  string */
    protected $casseteName;

    public function setUp()
    {
        parent::setUp();

        $this->elasticEmail = new ElasticEmail(getenv(self::API_KEY));
    }

    protected function getAppEnv()
    {
        return getenv('APP_ENV');
    }

    protected function getSenderEmail()
    {
        return getenv('SINGLE_TESTER_EMAIL');
    }

    /** @return EmailResponse */
    protected function sendSuccessfulEmail()
    {
        $response = $this->elasticEmail->email()->send([
            'to'      => $this->getRecipientEmail(),
            'subject' => $this->getSubjectEmail(),
            'from'    => "from-{$this->getRecipientEmail()}"
        ]);

        return $response;
    }

    protected function getRecipientEmail()
    {
        return getenv('SINGLE_TESTER_EMAIL');
    }

    protected function getSubjectEmail()
    {
        return getenv('EMAIL_SUBJECT');
    }
}