<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\ReactJS\SimplifiedPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $post = new Post();
        $post->setTitle('Post 1');
        $post->setShortContent('Testowy opis');

        $post2 = new Post();
        $post2->setTitle('Post 2');
        $post2->setShortContent('Testowy opis 2');

        $data = [
            'posts'     => [
                SimplifiedPost::toArray($post),
                SimplifiedPost::toArray($post2),
            ]
        ];

        return $this->render('default/index.html.twig', [
            'base_dir'  => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'output'    => json_encode($data)
        ]);
    }
}
