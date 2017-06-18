<?php

namespace AppBundle\ReactJS;


abstract class Pagination
{
    /**
     * @param int $currentPage
     * @param int $pages
     * @return array
     */
    public static function toArray($currentPage, $pages)
    {
        $currentPage    = intval($currentPage);
        $pages          = intval($pages);

        return [
            'currentPage'   => $currentPage,
            'pages'         => $pages
        ];
    }
}
