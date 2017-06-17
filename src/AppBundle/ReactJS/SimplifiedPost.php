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
            'id'            => md5(microtime(true) . rand(0,9999)),
            'title'         => $post->getTitle(),
            'shortContent'  => $post->getShortContent(),
            'image'         => 'http://i43.tinypic.com/qovh5i.jpg'
        ];
    }
}

