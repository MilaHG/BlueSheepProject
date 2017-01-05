<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'products');
    }

    public function testCategory()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/category');
    }

    public function testDetail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'product');
    }

}
