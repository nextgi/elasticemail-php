<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 6/5/16
 */

namespace ElasticEmail;

use ElasticEmail\Email\Email;
use ElasticEmail\Subaccounts\Subaccounts;

/** Access to various categories API end points. */
class ElasticEmail
{
    /** @var Client */
    private $client;

    /**
     * ElasticEmail constructor.
     * @param $apiKey
     * @throws ElasticEmailException
     */
    public function __construct($apiKey)
    {
        $this->client = new Client($apiKey);
    }

    /** @return Email */
    public function email()
    {
        return new Email($this->client);
    }

    /** @return Subaccounts */
    public function subaccounts()
    {
        return new Subaccounts($this->client);
    }
}
