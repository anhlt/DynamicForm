<?php
/**
 * Created by PhpStorm.
 * User: letuananh
 * Date: 2/10/17
 * Time: 15:10:56
 */

namespace App\Libraries\DynamicFormManager;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class Facade extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return 'DynamicForm'; // the IoC binding.
    }
}