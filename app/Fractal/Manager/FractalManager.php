<?php
/**
 * Created by PhpStorm.
 * User: zeel
 * Date: 10/1/19
 * Time: 4:40 PM
 */

namespace App\Fractal\Manager;


use League\Fractal\Manager;
use App\Fractal\Serializer\DataArraySerializer;

class fractalManager extends Manager
{
    public function __construct()
    {
        $this->setSerializer(new DataArraySerializer());
        $this->parseIncludes(app('request')->query('includes', ''));
        parent::__construct();
    }

}