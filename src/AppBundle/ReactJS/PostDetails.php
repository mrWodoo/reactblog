<?php

namespace AppBundle\ReactJS;

use AppBundle\Entity\Post;

abstract class PostDetails
{
    /**
     * @param Post $post
     * @return array
     */
    public static function toArray(Post $post)
    {
        return [
            'id'                    => $post->getId(),
            'title'                 => $post->getTitle(),
            'shortContent'          => $post->getShortContent(),
            'content'               => $post->getContent(),
            'image'                 => $post->getImage(),
            'createdAtTimestamp'    => $post->getCreatedAt()->getTimestamp()
        ];
    }
}

