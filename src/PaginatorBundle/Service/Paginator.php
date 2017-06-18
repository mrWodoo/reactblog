<?php

namespace PaginatorBundle\Service;
use Doctrine\ORM\QueryBuilder;
use PaginatorBundle\Enum\PaginatorEnum;


/**
 * Paginator service (offsetting, limiting)
 * @package PaginatorBundle\Service
 */
class Paginator
{
    /**
     * @var int
     */
    protected $resultsPerPage = PaginatorEnum::DEFAULT_PER_PAGE;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var QueryBuilder
     */
    protected $resourceQueryBuilder;

    /**
     * @var int
     */
    protected $allCount;

    /**
     * @return int
     */
    public function getResultsPerPage()
    {
        return $this->resultsPerPage;
    }

    /**
     * @param int $resultsPerPage
     */
    public function setResultsPerPage($resultsPerPage)
    {
        $resultsPerPage = intval($resultsPerPage);

        if ($resultsPerPage <= 0) {
            throw new \InvalidArgumentException('`resultsPerPage` must be higher than 0');
        }

        $this->resultsPerPage = $resultsPerPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param int $page
     */
    public function setCurrentPage($page)
    {
        $page = intval($page);

        if ($page < 1) {
            throw new \InvalidArgumentException('`page` must be higher than 0');
        }

        $this->currentPage = $page;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param int $allCount
     */
    public function setResultsResource(QueryBuilder $queryBuilder, $allCount)
    {
        $this->setAllCount($allCount);
        $this->resourceQueryBuilder = $queryBuilder;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->resourceQueryBuilder;
    }

    /**
     * @return int
     */
    public function getAllCount()
    {
        return $this->allCount;
    }

    /**
     * @param int $allCount
     */
    public function setAllCount($allCount)
    {
        $allCount = intval($allCount);

        if ($allCount < 0) {
            throw new \InvalidArgumentException('`allCount` must be at least equal to 0');
        }

        $this->allCount             = $allCount;
    }

    /**
     * @return array
     */
    public function paginate()
    {
        $pagesCount = ceil($this->allCount / $this->resultsPerPage);
        $start      = $this->currentPage * $this->resultsPerPage - $this->resultsPerPage;
        $results    = $this
            ->resourceQueryBuilder
            ->setMaxResults($this->resultsPerPage)
            ->setFirstResult($start)
            ->getQuery()
            ->getResult();

        return [
            'pages'         => $pagesCount,
            'currentPage'   => $this->currentPage,
            'results'       => $results
        ];
    }
}
