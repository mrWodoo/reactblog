<?php

namespace AppBundle\ReactJS;

use AppBundle\Entity\Post;

abstract class SimplifiedPost
{
    /**
     * @param Post $post
     * @return array
     */
    public static function toArray(Post $post)
    {
        return [
            'id'            => $post->getId(),
            'title'         => $post->getTitle(),
            'shortContent'  => $post->getShortContent(),
            'image'         => $post->getImage()
        ];
    }
}

