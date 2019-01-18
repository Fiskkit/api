<?php
/**
 * Created by PhpStorm.
 * User: zeel
 * Date: 9/1/19
 * Time: 5:15 PM
 */

namespace App\Http\Controllers;



use Illuminate\Http\JsonResponse;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;
use Closure;

class ApiController extends Controller
{
    public function abortJsonResponse($message, $statusCode)
    {
        return $this->returnJsonResponse(['message' => $message], $statusCode);
    }

    public function returnJsonResponse($data, $statusCode = 200)
    {
        return new JsonResponse($data, $statusCode);
    }

    public function collection($items, TransformerAbstract $transformer, Closure $callback = null)
    {
        $resources = new Collection($items, $transformer);
        if (!is_null($callback)) {
            call_user_func($callback, $resources);
        }

        return $this->buildResponse($resources);
    }

    private function buildResponse(ResourceInterface $resource)
    {
        $data = app('fiskkit.fractal.manager.fractal_manager')->createData($resource);

        return $this->returnJsonResponse($data->toArray());
    }

    public function paginateCollection($items, TransformerAbstract $transformer, Closure $callback = null)
    {
        if (method_exists($items, 'paginate') === true) {
            $paginator = $items->paginate(app('request')->query('perPage', 10));
            $paginator->appends(app('request')->query());
        } else {
            $paginator = $items;
        }

        $resource = new Collection($paginator, $transformer);
        if (!is_null($callback)) {
            call_user_func($callback, $resource);
        }
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        return $this->buildResponse($resource);
    }

    public function item($item, TransformerAbstract $transformer, Closure $callback = null)
    {
        $resource = new Item($item, $transformer);

        if (!is_null($callback)) {
            call_user_func($callback, $resource);
        }
        return $this->buildResponse($resource);
    }

}