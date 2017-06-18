<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testIndexPagination()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/page/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testIndexPaginationWrongPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/page/asd');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testFetchPostsActionIsOk()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/index/fetchPosts/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testFetchPostsActionWrongParameter()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/index/fetchPosts/asd');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
