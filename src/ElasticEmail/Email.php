<?php
/**
 * @author  Rizart Dokollari <r.dokollari@gmail.com>
 * @since   12/24/17
 */

namespace ElasticEmail;

use ElasticEmail\Email\Send;

class Email
{
    /** @var ElasticEmailClient */
    private $client;

    public function __construct(ElasticEmailClient $client)
    {
        $this->client = $client;
    }

    public function send()
    {
        return new Send($this->client);
    }
}