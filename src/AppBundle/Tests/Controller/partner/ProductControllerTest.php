<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Partner\ProductControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/edit');
    }

    public function testAddattribut()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addAttribut');
    }

    public function testDeleteattribut()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteAttribut');
    }

}
