<?php
/**
 * @author  Rizart Dokollari <r.dokollari@gmail.com>
 * @since   12/24/17
 */

namespace ElasticEmail\ElasticEmail;


interface ElasticEmailClientInterface
{
    /** @return ElasticEmailClientInterface */
    public function handle(array $params = []);
}