<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PreferenceControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'preference/list');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'preference/edit');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'preference/add');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'preference/delete');
    }

}
