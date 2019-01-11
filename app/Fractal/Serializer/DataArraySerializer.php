<?php
/**
 * Created by PhpStorm.
 * User: zeel
 * Date: 10/1/19
 * Time: 5:03 PM
 */

namespace App\Fractal\Serializer;

use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\DataArraySerializer as BaseArraySerializer;


class DataArraySerializer extends BaseArraySerializer
{
    /**
     * Serialize the paginator.
     *
     * @param PaginatorInterface $paginator
     *
     * @return array
     */
    public function paginator(PaginatorInterface $paginator)
    {
        $currentPage = (int)$paginator->getCurrentPage();
        $lastPage = (int)$paginator->getLastPage();

        $pagination = [
            'total' => (int)$paginator->getTotal(),
            'count' => (int)$paginator->getCount(),
            'per_page' => (int)$paginator->getPerPage(),
            'current_page' => $currentPage,
            'total_pages' => $lastPage
        ];

        $pagination['links'] = [];

        if ($currentPage > 1) {
            $pagination['links']['previous'] = $paginator->getUrl($currentPage - 1);
        }

        if ($currentPage < $lastPage) {
            $pagination['links']['next'] = $paginator->getUrl($currentPage + 1);
        }
        $pagination['links']['first'] = $paginator->getUrl(1);
        $pagination['links']['last'] = $paginator->getUrl($lastPage);
        $pagination['links']['current'] = $paginator->getUrl($currentPage);

        return ['pagination' => $pagination];
    }

    public function null()
    {
        return ['data' => null];
    }
}