<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Post;

class PostRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Get posts QueryBuilder for Paginator
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getPosts()
    {
        $query = $this->getQueryBuilder();

        return $query;
    }

    /**
     * @param $postId
     * @return null|object|Post
     */
    public function getById($postId)
    {
        $postId = intval($postId);

        if ($postId < 1) {
            throw new \InvalidArgumentException('`postId` must be higher than 0');
        }

        return $this
            ->getEntityManager()
            ->getRepository('AppBundle:Post')
            ->find($postId);
    }

    /**
     * @return int
     */
    public function countAllPosts()
    {
        return $this
            ->getQueryBuilder()
            ->select('COUNT(post)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this
            ->getEntityManager()
            ->createQueryBuilder()
            ->select('post')
            ->from('AppBundle:Post', 'post')
            ->orderBy('post.createdAt', 'desc');
    }
}
