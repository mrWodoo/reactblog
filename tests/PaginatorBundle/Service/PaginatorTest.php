<?php

namespace PaginatorBundle\Service;

use Doctrine\ORM\QueryBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PaginatorTest extends KernelTestCase
{
    /**
     * @var Paginator
     */
    protected $paginator;

    /**
     * Set up tested service
     */
    public function setUp()
    {
        $this->paginator = new Paginator();
    }

    public function testSetResultsPerPage()
    {
        $num    = rand(1,64);
        $result = $this->paginator->setResultsPerPage($num);
        $this->assertNull($result);

        $this->assertEquals($num, $this->paginator->getResultsPerPage());
    }

    public function testSetResultsPerPageWithWrongParameter()
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->paginator->setResultsPerPage('test');
        $this->paginator->setResultsPerPage(0);
    }

    public function testSetCurrentPage()
    {
        $num    = rand(1,64);
        $result = $this->paginator->setCurrentPage($num);
        $this->assertNull($result);

        $this->assertEquals($num, $this->paginator->getCurrentPage());
    }

    public function testSetCurrentPageWithWrongParameter()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->paginator->setCurrentPage('test');
        $this->paginator->setCurrentPage(0);
    }

    public function testSetAllCount()
    {
        $num    = rand(1,64);
        $result = $this->paginator->setAllCount($num);
        $this->assertNull($result);

        $this->assertEquals($num, $this->paginator->getAllCount());
    }

    public function testSetAllCountWithWrongParameter()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->paginator->setAllCount('test');
        $this->paginator->setAllCount(-1);
    }

    public function testSetResultsResource()
    {
        $num = rand(1,64);
        $mock = $this
            ->createMock(QueryBuilder::class);

        $this->paginator->setResultsResource($mock, $num);

        $this->assertEquals($num, $this->paginator->getAllCount());
    }

    public function testPaginate()
    {
        $num    = rand(1,64);
        $mock   = $this
            ->getMockBuilder(QueryBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'setMaxResults',
                'setFirstResult',
                'getQuery',
                'getResult'
            ])
            ->getMock();

        $mock
            ->method('setMaxResults')
            ->willReturnSelf();

        $mock
            ->method('setFirstResult')
            ->willReturnSelf();

        $mock
            ->method('getQuery')
            ->willReturnSelf();

        $mock
            ->method('getResult')
            ->willReturn([]);

        $this->paginator->setResultsResource($mock, $num);

        $result = $this->paginator->paginate();

        $this->assertArrayHasKey('pages', $result);
        $this->assertArrayHasKey('currentPage', $result);
        $this->assertArrayHasKey('results', $result);
    }
}
