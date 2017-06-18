<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\ReactJS\Pagination;
use AppBundle\ReactJS\PostDetails;
use AppBundle\ReactJS\SimplifiedPost;
use AppBundle\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use PaginatorBundle\Service\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/page/{page}", name="homepageWithPage", requirements={"page": "([0-9]{1,3})"})
     */
    public function indexAction(
        $page = 1,
        Request $request,
        EntityManagerInterface $entityManager,
        Paginator $paginator
    )
    {
        /** @var PostRepository $postRepository */
        $postRepository = $entityManager
            ->getRepository('AppBundle:Post');

        // Paginate posts
        $paginator->setCurrentPage($page);
        $paginator->setResultsResource($postRepository->getPosts(), $postRepository->countAllPosts());
        $pagination = $paginator->paginate();

        // Prepare data structure for output
        $data   = [
            'posts'         => [],
            'pagination'    => []
        ];

        foreach ($pagination['results'] AS $post) {
            $data['posts'][] = SimplifiedPost::toArray($post);
        }

        $data['pagination'] = Pagination::toArray($pagination['currentPage'], $pagination['pages']);

        return $this->render('default/index.html.twig', [
            'base_dir'  => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'output'    => json_encode($data)
        ]);
    }

    /**
     * @Route("/post/{postId}", name="postDetails", requirements={"postId": "([0-9]{1,3})"})
     */
    public function postDetailsAction(
        $postId = 1,
        Request $request,
        EntityManagerInterface $entityManager
    )
    {
        /** @var PostRepository $postRepository */
        $postRepository = $entityManager
            ->getRepository('AppBundle:Post');

        $post = $postRepository->getById($postId);

        $data = [
            'post'      => PostDetails::toArray($post),
            'comments'  => [],
            'time'      => time()
        ];

        return $this->render('default/index.html.twig', [
            'base_dir'  => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'output'    => json_encode($data)
        ]);
    }

    /**
     * @Route("/api/index/fetchPosts/{page}", name="apiIndexFetchPosts", requirements={"page": "([0-9]{1,3})"})
     */
    public function fetchPostsAction(
        $page = 1,
        Request $request,
        EntityManagerInterface $entityManager,
        Paginator $paginator)
    {
        /** @var PostRepository $postRepository */
        $postRepository = $entityManager
            ->getRepository('AppBundle:Post');

        // Paginate posts
        $paginator->setCurrentPage($page);
        $paginator->setResultsResource($postRepository->getPosts(), $postRepository->countAllPosts());
        $pagination = $paginator->paginate();

        // Prepare data structure for output
        $data   = [
            'posts'         => [],
        ];

        foreach ($pagination['results'] AS $post) {
            $data['posts'][] = SimplifiedPost::toArray($post);
        }

        return new JsonResponse($data);
    }
}
