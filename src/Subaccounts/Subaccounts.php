<?php
/**
 * @author  Rizart Dokollari <r.dokollari@gmail.com>
 * @since   12/24/17
 */

namespace ElasticEmail\Subaccounts;

use ElasticEmail\Client;

/**
 * Access to Email API end points.
 * @see http://api.elasticemail.com/public/help#Email_header
 */
class Subaccounts
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function listaccounts(array $params = [])
    {
        $send = new Listaccounts($this->client);

        return $send->handle($params);
    }
}