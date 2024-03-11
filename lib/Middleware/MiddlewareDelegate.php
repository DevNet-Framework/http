<?php

/**
 * @author      Mohammed Moussaoui
 * @license     MIT license. For more license information, see the LICENSE file in the root directory.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Http\Middleware;

use DevNet\System\Delegate;
use DevNet\Http\Message\HttpContext;

class MiddlewareDelegate extends Delegate
{
    /** RequestDelegate signature */
    public function middlewareDelegate(HttpContext $context, RequestDelegate $next)
    {
    }
}
